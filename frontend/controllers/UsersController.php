<?php
namespace frontend\controllers;

use common\enums\BalanceOperation;
use common\enums\Role;
use common\enums\UserStatus;
use common\helpers\HDev;
use common\models\BalanceHistory;
use common\models\Company;
use common\models\User;
use frontend\components\Controller;
use frontend\models\ChangeBalance;
use frontend\models\UserAdminForm;
use frontend\models\UserAdvertiserFilter;
use frontend\models\UserAdvertiserForm;
use frontend\models\UserEmployeeForm;
use frontend\models\UserForm;
use frontend\models\UserPartnerFilter;
use frontend\models\UserPartnerForm;
use Yii;
use yii\base\NotSupportedException;
use yii\bootstrap\ActiveForm;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Response;

/**
 *  Users controller
 */
class UsersController extends Controller
{

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
                        'actions' => ['company-detail'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],[
                        'actions' => ['my-page'],
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

    public function actionView($id)
    {
        $model = $this->getForm($id);
        $userOwner = Yii::$app->user->getIdentity();
        $isAdmin = Yii::$app->user->can(Role::ADMIN);

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

        return $this->render('view', compact('model'));
    }


}
