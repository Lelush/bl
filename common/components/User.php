<?php
/**
 * Created by PhpStorm.
 * User: mirocow
 * Date: 03.07.15
 * Time: 20:39
 */

namespace common\components;

use common\enums\Role;
use Yii;

/**
 * Class View
 * @package frontend\components
 * @method \common\models\User getIdentity()
 * @property string $regionName  @readonly
 */
class User extends \yii\web\User
{
    /**
     * This method is called after the user is successfully logged in.
     * The default implementation will trigger the [[EVENT_AFTER_LOGIN]] event.
     * If you override this method, make sure you call the parent implementation
     * so that the event is triggered.
     * @param \common\models\User $identity the user identity information
     * @param boolean $cookieBased whether the login is cookie-based
     * @param integer $duration number of seconds that the user can remain in logged-in status.
     * If 0, it means login till the user closes the browser or the session is manually destroyed.
     */
    protected function afterLogin($identity, $cookieBased, $duration, $fromForum=false)
    {
        $identity->touch('last_visit');
        parent::afterLogin($identity, $cookieBased, $duration); // TODO: Change the autogenerated stub
    }

    /**
     * @inheritdoc
     */
    public function can($role, $params = [], $allowCaching = true)
    {
        /** @var \common\models\User $user */
        $user = $this->getIdentity();

        if (!$user) return false;

        if ($user->role == Role::ADMIN && $role == Role::MANAGER) return true;

        return $user && $user->role == $role;
    }

    /**
     * установка окружения для виртуального режима.
     */
    public function setVirtualMode(){
        Yii::$app->session->set('virtualMode',true);
        Yii::$app->session->set('virtualModeOwner',$this->getIdentity()->id);
        Yii::$app->session->set('OwnerLastUrl',Yii::$app->request->referrer);
    }

    /**
     * удаление окружения для виртуального режима.
     */
    public function unsetVirtualMode(){
        Yii::$app->session->offsetUnset('virtualMode');
        Yii::$app->session->offsetUnset('virtualModeOwner');
        Yii::$app->session->offsetUnset('OwnerLastUrl');
    }

    /**
     * проверка вирутальный ли сейчас режим
     */
    public function isVirtualMode(){
        return  (bool) Yii::$app->session->get('virtualMode',false);
    }

    /**
     * получить хозяина виртуального режима.
     * @return bool|mixed
     */
    public function getVirtualOwner(){
        if($this->isVirtualMode()){
            return Yii::$app->session->get('virtualModeOwner');
        }else{
            return false;
        }
    }
    public function getOwnerLastUrl(){
        return Yii::$app->session->get('OwnerLastUrl');
    }
}
