<?php
/* @var $this \frontend\components\View */
use yii\bootstrap\Html;

/* @var $offer \common\models\Offer */
/* @var $user \common\models\User */
?>
<div >
    <p>Пользователь <?= Html::encode($user->username) ?>,</p>
    <p>запросил подключение к офферу: <?= Html::encode($offer->name) ?></p>
</div>
