<?php

use yii\helpers\Html;
use backend\models\UserForm;
use backend\widgets\ThemeForm;

/* @var $this \backend\components\View */
/* @var $model UserForm */
/* @var $form ThemeForm */
/* @var $type string */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'User',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Пользователи'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактирование '.$model->id);
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'type' => $model->role,
    ]) ?>

</div>
