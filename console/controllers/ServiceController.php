<?php
namespace console\controllers;
use common\enums\Role;
use common\models\User;
use console\components\Controller;

/**
 * Вспомогательные консольные команды
 * @package console\controllers
 */
class ServiceController  extends Controller
{


    /**
     * Генерация и загрузка фикстур в БД. !!!ВНИМАНИЕ!!! Очищает таблицы от данных, не применять на продакшене
     */
//    public function actionInitFixtures()
//    {
//        //trancate не работает из-за внешних ключей :(
//        Lead::deleteAll();
//        Ecommerce::deleteAll();
//        Conversion::deleteAll();
//        Transaction::deleteAll();
//        Order::deleteAll();
//        Landing::deleteAll();
//        Goal::deleteAll();
//        OfferStatus::deleteAll();
//        OfferBrokerSetting::deleteAll();
//        OfferPartner::deleteAll();
//        Offer::deleteAll();
//        User::deleteAll();
//        Company::deleteAll();
//        SxGeoCity::deleteAll();
//        SxGeoRegion::deleteAll();
//        SxGeoCountry::deleteAll();
//
//
//        $this->consoleRun('fixture/generate company --count=20 --interactive=0');
//        $this->consoleRun('fixture/load Company --interactive=0');
//
//        $this->consoleRun('fixture/generate offer --count=10 --interactive=0');
//        $this->consoleRun('fixture/load Offer --interactive=0');
//
//        $this->consoleRun('fixture/generate goal --count=40 --interactive=0');
//        $this->consoleRun('fixture/load Goal --interactive=0');
//
//        $this->consoleRun('fixture/generate landing --count=40 --interactive=0');
//        $this->consoleRun('fixture/load Landing --interactive=0');
//
//        $this->consoleRun('fixture/load Order --interactive=0');
//        $this->consoleRun('fixture/load User --interactive=0');
//        $this->consoleRun('fixture/load OfferBrokerSetting --interactive=0');
//
//        $this->consoleRun('geo/update');
//    }
//
//    private function consoleRun($cmd)
//    {
//        $output = '';
//        \Yii::$app->consoleRunner->run($cmd, $output);
//        echo $output;
//    }

    public function actionAdminCreate()
    {
        $user = new User();
        $user->role = Role::ADMIN;
        $user->email = 'admin@bl.ru';
        $user->setPassword('123456');
        $user->ref = \Yii::$app->getSecurity()->generateRandomString(24);
        $user->generateAuthKey();
        $user->generatePasswordResetToken();
        if($user->save()) {
            $this->log('admin create');
        }else{
            $this->log(var_export($user->getErrors(), true));

        }
    }


}
