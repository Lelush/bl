<?php
namespace console\controllers;
use common\enums\Role;
use common\models\User;
use console\components\Controller;

/**
 * Вспомогательные консольные команды
 * @package console\controllers
 */
class CacheController  extends Controller
{


    public function actionFlush()
    {
        \Yii::app()->cache->flush();
        $this->log('cache flush');
    }


}
