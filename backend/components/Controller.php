<?php
/**
 * Created by PhpStorm.
 * User: kkurkin
 * Date: 4/21/15
 * Time: 4:02 PM
 */

namespace backend\components;


use common\enums\UserStatus;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;

class Controller extends \yii\web\Controller
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
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    protected function setFlash($type, $message)
    {

        Yii::$app->getSession()->setFlash($type, $message);
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return Yii::$app->user->identity;
    }
    public function beforeAction($action)
    {
        /** @var $user User */
        $user  = Yii::$app->user->identity;
        $aNoViewBlockActions =['block','logout'];
        if($user && !in_array($action->id,$aNoViewBlockActions) && $user->status == UserStatus::DELETED){
            return $this->redirect(Url::to('/site/block'));
        }
        return parent::beforeAction($action);
    }
}
