<?php
namespace  backend\controllers\action\site;
use common\enums\UserStatus;
use Yii;
use yii\helpers\Url;

class ErrorAction extends \yii\web\ErrorAction
{
    public function run()
    {
        $user = Yii::$app->user->identity;
        if($user && $user->status == UserStatus::DELETED){
            return $this->controller->redirect(Url::to('/site/block/'))->send();
        }
        if(!$user){
            return $this->controller->redirect(Url::home())->send();
        }
        return parent::run();
    }
}
