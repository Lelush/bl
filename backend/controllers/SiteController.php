<?php
namespace backend\controllers;

use common\enums\Role;
use common\enums\UserStatus;
use common\models\User;
use backend\components\Controller;
use backend\models\LoginForm;
use backend\models\PasswordResetRequestForm;
use backend\models\ResetPasswordForm;
use backend\models\SignupForm;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'logout', 'signup','virtual-login'],
                'rules' => [
                    [
                        'actions' => ['login', 'signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['virtual-login'],
                        'allow' => true,
                        'roles' => [Role::ADMIN,Role::MANAGER],
                    ]
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'backend\controllers\action\site\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionBlock()
    {
        $user = Yii::$app->user->identity;
        if(!$user || $user->status != UserStatus::DELETED){
            return $this->redirect(Url::home());
        }
        $this->layout = 'guest';
        return $this->render('block');
    }
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'guest';
        $model = new LoginForm();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($model->login()) {
                if (!Yii::$app->user->isGuest) {
                    return $this->redirect(Yii::$app->request->referrer);
                }
                return Yii::$app->controller->goBack();
            }else{
                return ActiveForm::validate($model);
            }
        }
        $login = Yii::$app->request->get('name');
        return $this->render('login', [
            'model' => $model,
            'login' => $login,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Метод  авторизует админа или менеджера под пользователем с указаным ID.
     * со всеми последствиями.
     *
     * @param $id
     *
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionVirtualLogin($id)
    {
        /**
         * @var $ownerUser \backend\components\User
         */
        $ownerUser = Yii::$app->user;

        if(!$ownerUser->isVirtualMode() && $ownerUser->id != $id){
            $virtualUser = $this->findUser($id);
            if($virtualUser->status == UserStatus::DELETED){
                $this->setFlash('error', "Пользователь заблокирован, вход невозможен.");
                return $this->redirect(Yii::$app->request->referrer);
            }
            $ownerUser = Yii::$app->user;
            $ownerUser->setVirtualMode();
            Yii::$app->user->login($virtualUser, 3600 * 24 * 30);
        }

        return $this->redirect('/offers');
    }

    /**
     * Метод выводит из виртуального  режима если таковой есть и перенеправляет на главную.
     * @throws NotFoundHttpException
     */
    public function actionVirtualLogout()
    {
        /**
         * @var $virtualUser \backend\components\User
         */
        $virtualUser = Yii::$app->user;
        if ($virtualUser->isVirtualMode()) {
            $ownerUser = $this->findUser($virtualUser->getVirtualOwner());
            $redirectUrl = $virtualUser->getOwnerLastUrl();
            $virtualUser->unsetVirtualMode();
            Yii::$app->user->login($ownerUser, 3600 * 24 * 30);
            return $this->redirect($redirectUrl ? $redirectUrl : Url::home());
        }
        return $this->redirect('/');
    }

    private function findUser($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Пользователь не найдет');
        }
    }
}

