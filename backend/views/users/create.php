<?php

use common\enums\Role;
use yii\widgets\ActiveForm;
use backend\widgets\PanelBlock;
use yii\widgets\MaskedInput;
use backend\models\UserForm;
use yii\bootstrap\Html;
use backend\widgets\ImageUploadWidget;
use common\enums\UserCategory;
use common\enums\UserGender;
use backend\widgets\ThemeForm;

/* @var $this \backend\components\View */
/* @var $model UserForm */
/* @var $form ThemeForm */
/* @var $type string */
$this->title = 'Новый пользователь';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Пользователи'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$model->role = $type;
?>
<div class="theme-primary tab-block">
    <div class="tab-content">

        <?= $this->render('_form', [
            'model' => $model,
            'type'=> $type
        ]) ?>
    </div>
</div>