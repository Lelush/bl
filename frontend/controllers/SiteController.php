<?php
namespace frontend\controllers;

use common\enums\CompanyCategory;
use common\enums\Role;
use common\enums\UserCategory;
use common\models\Company;
use common\models\CompanyInfo;
use common\models\UserInfo;
use frontend\models\UserForm;
use kartik\form\ActiveForm;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use frontend\components\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\Response;

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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
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
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/my-page');
        }
        $model = new LoginForm();
//        $this->layout = 'guest';
        if ($model->load(Yii::$app->request->post())) {
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
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post())) {
            if( ArrayHelper::keyExists('add', Yii::$app->request->post()) ) {
                $model->subject = 'Сообщение с сайта "Добавить"';
            }
            if( ArrayHelper::keyExists('complete', Yii::$app->request->post()) ) {
                $model->subject = 'Сообщение с сайта "Дополнить"';
            }
            if( ArrayHelper::keyExists('suggest', Yii::$app->request->post()) ) {
                $model->subject = 'Сообщение с сайта "Предложить"';
            }
            if(ArrayHelper::keyExists('change', Yii::$app->request->post()) ) {
                $model->subject = 'Сообщение с сайта "Изменить"';
            }

            if ($model->validate() && $model->sendEmail(Yii::$app->params['adminEmail'])) {
                $this->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
                return $this->refresh();
            } else {
                $this->setFlash('danger', 'Произошла ошибка, проверьте данные');;
            }

            var_dump($model->attributes);
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionTerms()
    {
        return $this->render('terms');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new UserForm();
        $model->setScenario('signup');
        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            if ($model->save()) {
                if (Yii::$app->getUser()->login($model)) {
                    return $this->redirect(['/site/choose']);
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionChoose()
    {
        return $this->render('choose', [
        ]);
    }

    /**
     * @return mixed
     */
    public function actionCompany()
    {
        $user = UserForm::findOne(Yii::$app->getUser()->identity->getId());

        if(Yii::$app->request->post() && $user){

            if(ArrayHelper::keyExists('food',Yii::$app->request->post())){
                $userInfo = UserInfo::find()->where(['user_id'=>$user->id])->one();
                if(!$userInfo) {
                    $userInfo = new UserInfo();
                }
                $userInfo->scope = CompanyCategory::FOOD;
                $userInfo->user_id = $user->id;
                $user->role = Role::COMPANY;
                $user->modelUserInfo = $userInfo;
                if( $user->save() ) {
                    $this->redirect(['/users/my-page']);
                } else {
                    $this->setFlash('danger', 'Произошла ошибка, проверьте данные');
                }
            }

            if(ArrayHelper::keyExists('shopping',Yii::$app->request->post())){
                $userInfo = UserInfo::find()->where(['user_id'=>$user->id])->one();
                if(!$userInfo) {
                    $userInfo = new UserInfo();
                }
                $userInfo->scope = CompanyCategory::SHOPPING;
                $userInfo->user_id = $user->id;
                $user->role = Role::COMPANY;
                $user->modelUserInfo = $userInfo;
                if( $user->save() ) {
                    $this->redirect(['/users/my-page']);
                } else {
                    $this->setFlash('danger', 'Произошла ошибка, проверьте данные');
                }
            }

            if(ArrayHelper::keyExists('services',Yii::$app->request->post())){
                $userInfo = UserInfo::find()->where(['user_id'=>$user->id])->one();
                if(!$userInfo) {
                    $userInfo = new UserInfo();
                }
                $userInfo->scope = CompanyCategory::SERVICES;
                $userInfo->user_id = $user->id;
                $user->role = Role::COMPANY;
                $user->modelUserInfo = $userInfo;
                if( $user->save() ) {
                    $this->redirect(['/users/my-page']);
                } else {
                    $this->setFlash('danger', 'Произошла ошибка, проверьте данные');
                }
            }

            if(ArrayHelper::keyExists('entertainment',Yii::$app->request->post())){
                $company = Company::find()->where(['user_id'=>$user->id])->one();
                if(!$company) {
                    $company = new Company();
                }
                $company->scope = CompanyCategory::ENTERTAINMENT;
                $company->user_id = $user->id;
                $user->role = Role::COMPANY;
                $user->modelCompany = $company;
                if( $user->save() ) {
                    $this->redirect(['/users/my-page']);
                } else {
                    $this->setFlash('danger', 'Произошла ошибка, проверьте данные');
                }
            }
        }
        return $this->render('company', [
        ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionUsers()
    {
        $user = UserForm::findOne(Yii::$app->getUser()->identity->getId());

        if(Yii::$app->request->post() && $user){
            if(ArrayHelper::keyExists('Luxury',Yii::$app->request->post())){
                $userInfo = UserInfo::find()->where(['user_id'=>$user->id])->one();
                if(!$userInfo) {
                    $userInfo = new UserInfo();
                }
                $userInfo->scope = UserCategory::LUXURY;
                $userInfo->user_id = $user->id;
                $user->role = Role::USER;
                $user->modelUserInfo = $userInfo;
                if( $user->save() ) {
                    $this->redirect(['/users/my-page']);
                } else {
                    $this->setFlash('danger', 'Произошла ошибка, проверьте данные');
                }
            }

            if(ArrayHelper::keyExists('Discounter',Yii::$app->request->post())){
                $userInfo = UserInfo::find()->where(['user_id'=>$user->id])->one();
                if(!$userInfo) {
                    $userInfo = new UserInfo();
                }
                $userInfo->scope = UserCategory::DISCOUNTER;
                $userInfo->user_id = $user->id;
                $user->role = Role::USER;
                $user->modelUserInfo = $userInfo;
                if( $user->save() ) {
                    $this->redirect(['/users/my-page']);
                } else {
                    $this->setFlash('danger', 'Произошла ошибка, проверьте данные');
                }
            }

            if(ArrayHelper::keyExists('Popular',Yii::$app->request->post())){
                $userInfo = UserInfo::find()->where(['user_id'=>$user->id])->one();
                if(!$userInfo) {
                    $userInfo = new UserInfo();
                }
                $userInfo->scope = UserCategory::POPULAR;
                $userInfo->user_id = $user->id;
                $user->role = Role::USER;
                $user->modelUserInfo = $userInfo;
                if( $user->save() ) {
                    $this->redirect(['/users/my-page']);
                } else {
                    $this->setFlash('danger', 'Произошла ошибка, проверьте данные');
                }
            }

            if(ArrayHelper::keyExists('Rich',Yii::$app->request->post())){
                $userInfo = UserInfo::find()->where(['user_id'=>$user->id])->one();
                if(!$userInfo) {
                    $userInfo = new UserInfo();
                }
                $userInfo->scope = UserCategory::RICH;
                $userInfo->user_id = $user->id;
                $user->role = Role::USER;
                $user->modelUserInfo = $userInfo;
                if( $user->save() ) {
                    $this->redirect(['/users/my-page']);
                } else {
                    $this->setFlash('danger', 'Произошла ошибка, проверьте данные');
                }
            }

            if(ArrayHelper::keyExists('Tourist',Yii::$app->request->post())){
                $userInfo = UserInfo::find()->where(['user_id'=>$user->id])->one();
                if(!$userInfo) {
                    $userInfo = new UserInfo();
                }
                $userInfo->scope = UserCategory::TOURIST;
                $userInfo->user_id = $user->id;
                $user->role = Role::USER;
                $user->modelUserInfo = $userInfo;
                if( $user->save() ) {
                    $this->redirect(['/users/my-page']);
                } else {
                    $this->setFlash('danger', 'Произошла ошибка, проверьте данные');
                }
            }
        }

        return $this->render('users', [
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
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
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
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
