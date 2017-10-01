<?php

use common\enums\Role;
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
?>

<?php $form = ThemeForm::begin([
    'enableAjaxValidation' => true,
    'validateOnBlur'       => true,
]); ?>
<div class="row">

    <? PanelBlock::begin([
        'title' => $this->title,
        'options' => [
            'class' => 'col-sm-7'
        ]
    ]);?>

    <?= $form->field($model, 'role')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'last_name')->textInput(['placeholder'=>'Введите фамилию']) ?>
    <?= $form->field($model, 'first_name')->textInput(['placeholder'=>'Введите имя']) ?>
    <?= $form->field($model, 'phone')->textInput(['placeholder'=>'Введите телефон']) ?>
    <?= $form->field($model, 'email')->textInput(['placeholder'=>'Введите email']) ?>
    <? PanelBlock::end();?>
    <? PanelBlock::begin([
        'title' => 'Дополнительная информация',
        'options' => [
            'class' => 'col-sm-5 pull-right'
        ]
    ]);?>
    <? if($type==Role::USER):?>
        <div class="col-sm-12">
            <?= $form->field($model->modelUserInfo, "avatar")->widget(ImageUploadWidget::classname(), ['type' => \common\enums\ImageType::USER, 'src' => $model->modelUserInfo->getLogoSrc()]); ?>
            <?= $form->field($model->modelUserInfo, "scope")->dropDownList(UserCategory::getList(),['prompt'=>'Выберите категорию']); ?>
            <?= $form->field($model->modelUserInfo, "gender")->dropDownList(UserGender::getList(), ['prompt'=>'Выберите пол']); ?>
            <?= $form->field($model->modelUserInfo, "about")->textarea(); ?>
        </div>
    <? endif; ?>
    <? if($type==Role::COMPANY):?>
        <div class="col-sm-12">
            <?= $form->field($model->modelCompany, "avatar")->widget(ImageUploadWidget::classname(), ['type' => \common\enums\ImageType::COMPANY, 'src' => $model->modelCompany->getLogoSrc()]); ?>
            <?= $form->field($model->modelCompany, "scope")->dropDownList(UserCategory::getList(),['prompt'=>'Выберите категорию']); ?>
            <?= $form->field($model->modelCompany, "link")->textInput(); ?>
            <?= $form->field($model->modelCompany, "name")->textInput(); ?>
        </div>
    <? endif; ?>
    <? PanelBlock::end();?>
    <div class="col-sm-7">
        <div class="form-group pull-right">
            <?= Html::a('Отмена',['/users/index'], ['class' => 'btn btn-default']) ?>
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
</div>
<?php ThemeForm::end(); ?>
<div class="clearfix"></div>
