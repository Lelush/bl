<?php
use backend\widgets\AdminForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form AdminForm */
/* @var $model \common\models\LoginForm */
/* @var $login string|null */

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-panels">
    <div class="col-md-6 col-xs-12 image-block hidden-md hidden-lg">
        <img src="<?=Yii::getAlias('@static')?>/img/1_step.png"/>
    </div>

    <?php $form = \yii\bootstrap\ActiveForm::begin(['id' => 'login-form']); ?>
    <?= $form->errorSummary($model)?>
        <div class="col-md-6 col-xs-12">
            <div id="reg_1" class="registration first">
                <h1 class="reg-heading">
                    Вход
                </h1>
                <span class="reg-text">
                  Введите свои данные для подтверждения личности
                </span>
                <?= $form->field($model, 'email')->textInput(['value'=>$login,'class'=>'reg-input','placeholder'=>'Ваш e-mail'])->label(false);?>
                <?= $form->field($model, 'password')->passwordInput(['value'=>$login?'123456':null,'class'=>'reg-input','placeholder'=>'Ваш пароль'])->label(false);?>

                <div class="reg-buttons">
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4">
                    <?= Html::submitButton('Войти', ['class' => 'reg-button next', 'name' => 'login-button']) ?>
                    </div>
                </div>
            </div>

        </div>
    <? \yii\bootstrap\ActiveForm::end();?>

    <div class="col-md-6 col-xs-12 image-block hidden-xs">
        <img src="<?=Yii::getAlias('@static')?>/img/1_step.png" style="width: 100%"/>
    </div>

</div>