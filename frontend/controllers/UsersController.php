<?php
namespace frontend\controllers;

use common\enums\FriendsStatus;
use common\enums\Role;
use common\models\Friends;
use common\models\User;
use frontend\components\Controller;
use frontend\models\FriendsForm;
use frontend\models\UserForm;
use Yii;
use yii\base\NotSupportedException;
use yii\bootstrap\ActiveForm;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Response;

/**
 *  Users controller
 */
class UsersController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'uploadPhoto' => [
                'class' => 'frontend\widgets\cropper\actions\UploadAction',
                'url' => Yii::getAlias('@static').'/images/user',
                'path' => '@upload/images/user',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['my-friends','friends','my-page','view'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                    [
                        'actions' => ['edit','uploadPhoto', 'toggle-friends'],
                        'allow'   => true,
                        'roles'   => [
                            Role::COMPANY,
                            Role::USER,
                        ],
                    ],
                    [
                        'allow' => true,
                        'roles' => [
                            Role::ADMIN,
                            Role::MANAGER,
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * @param $id
     *
     * @return User
     * @throws NotSupportedException
     */
    protected function findUser($id)
    {
        if ($model = User::findOne($id)) {
            return $model;
        }
        throw new NotSupportedException('Пользователь не найден.');
    }

    /**
     * метод получения формы из роли пользователя.
     *
     * @param $id
     *
     * @return null|UserForm
     * @throws NotSupportedException
     */
    private function getForm($id)
    {
        $model = $this->findUser($id);
        switch ($model->role) {
            case Role::USER:
                $model  = UserForm::findOne($id);
                $model->loadModels();
                //фильтр тут бы загрузить
                return $model;

            case Role::COMPANY:
            default:
                $model  = UserForm::findOne($id);
                $model->loadModels();
                return $model;
        }
        return null;
    }
    /**
     *   метод посредник для просмотра пользователем себя самого.
     * @return string
     */
    public function actionMyPage(){
        return $this->actionView(Yii::$app->user->getIdentity()->id);
    }

    public function actionToggleFriends()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $userOwner = Yii::$app->getUser()->getIdentity();
        $friendId = Yii::$app->getRequest()->post('id');

        $friend = Friends::find()->where(['friend_from'=>$userOwner->getId(), 'friend_to'=>$friendId])->one();

        if(!$friend) {
            $friend = new Friends();
            $friend->friend_from = $userOwner->getId();
            $friend->friend_to = $friendId;
        }

        if(!$friend->status && !$friend->isNewRecord) {
            $friend->status = FriendsStatus::DELETE;
        } else {
            $friend->status = FriendsStatus::WAIT;
        }

        if($friend->save()) {
            return ['success'=>true, 'btnText'=>$friend->status == FriendsStatus::DELETE ? 'Пригласить' : 'Отменить'];
        }

        return ['errors'=>$friend->getErrors(),'message'=>'Что-то пошло не так', ];
    }

    public function actionView($id)
    {
        $model = $this->findUser($id);
        $userOwner = Yii::$app->user->getIdentity();
        if($userOwner->getId() != $model->getId()) {
            $model->updateCounters(['views'=>1]);
        }
        $users = $model
            ->getNotFriendUsers()
            ->limit(6)
            ->all();
//        $isAdmin = Yii::$app->user->can(Role::ADMIN);

        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validate($model),
                    $model->company?ActiveForm::validate($model->company):[]
                );
            }
            if ($model->save()) {
                if ($model->newPassword) {
                    $model->setPassword($model->newPassword);
                    if ($model->save()) {
                        $this->setFlash('info', "Пароль успешно изменен");
                    }
                }else{
                    $this->setFlash('success', 'Пользователь ' . $model->fullName . ' успешно изменен');
                }
                if(Yii::$app->request->post('ajax-save', false)){
                    $this->redirect(Yii::$app->request->referrer);
                }else{
                    $model->refresh();
                }
            } else {
                $this->setFlash('error', ACTION_VALIDATE_ERROR);
            }
        }

        return $this->render('view', compact('model', 'userOwner', 'users'));
    }



    public function actionEdit()
    {
        $model = $this->getForm(Yii::$app->user->getIdentity()->id);
        $userOwner = Yii::$app->user->getIdentity();
//        $isAdmin = Yii::$app->user->can(Role::ADMIN);

        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validate($model),
                    $model->modelCompany ? ActiveForm::validate($model->modelCompany) : [],
                    $model->modelUserInfo ? ActiveForm::validate($model->modelUserInfo) : []
                );
            }
            if ($model->save()) {
                $this->setFlash('success', ACTION_CREATE_SUCCESS);

                return $this->redirect(['my-page']);
            } else {
                $this->setFlash('error', ACTION_VALIDATE_ERROR);
            }
        }

        $model->loadModels();

        return $this->render('edit', compact('model', 'userOwner'));
    }

    /**
     *   метод посредник для просмотра пользователем себя самого.
     * @return string
     */
    public function actionMyFriends(){
        return $this->actionFriends(Yii::$app->user->getIdentity()->id);
    }

    public function actionFriends($id)
    {
        $model = $this->findUser($id);
        $userOwner = Yii::$app->user->getIdentity();
//        $isAdmin = Yii::$app->user->can(Role::ADMIN);

        $searchModel = new FriendsForm();
        $dataProvider = $searchModel->search($model,Yii::$app->request->queryParams);

        return $this->render('friends', [
            'isOwner' => $userOwner->getId() == $model->id,
            'model' => $model,
            'userOwner' => $userOwner,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'onlineCount' => 0,
        ]);

    }
}
