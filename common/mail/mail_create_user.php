<?php
/* @var $this \backend\components\View */
use yii\bootstrap\Html;

/* @var $user \common\models\User */
$link = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
$name =
    $user->fullName;
?>
<div >
    <p>Здравствуйте <?= Html::encode($name) ?>,</p>

    <p>Мы закончили создание вашей учетной записи. Теперь Вы можете использовать эту учетную запись чтобы войти в <?= Yii::$app->name?>.</p>

    <p>Почта для входа: <?= Html::encode($user->username);?></p>
    <p>Пароль для входа: <?= Html::encode($user->newPassword);?></p>
    <br>
    <p>Нажмите на ссылку ниже, чтобы войти.</p>
    <p><?= Html::a(Html::encode($link), $link) ?></p>
</div>
