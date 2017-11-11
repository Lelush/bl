<?php

/* @var $this yii\web\View */
/* @var $form ThemeForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use frontend\widgets\ThemeForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="admin-panels">
<div class="col-md-6 col-xs-12 image-block hidden-md hidden-lg">
    <img src="<?=Yii::getAlias('@static')?>/img/1_step.png"/>
</div>

<?php $form = ThemeForm::begin(['id' => 'registration-form']); ?>
    <div class="col-md-6 col-xs-12">
        <div id="reg_1" class="registration first">
            <h1 class="reg-heading">
                <?=$this->title?>
            </h1>
            <span class="reg-text">
                  Впервые в BL?
                </span>
            <span class="reg-text">
                  Укажите свои данные чтобы быстрее найти<br/>
                  друзей и близких
                </span>

            <?= $form->field($model,'first_name')->textInput(['class'=>'form-control reg-input','placeholder'=>'Ваше имя'])->label(false)?>
            <?= $form->field($model,'last_name')->textInput(['class'=>'form-control reg-input','placeholder'=>'Ваша фамилия'])->label(false)?>

            <span class="form-label">Дата рождения</span>
            <div class="row">
                <div class="col-xs-12">
                    <?= $form->field($model,'bd_day',['options'=>['style'=>"width:45px;float:left;"]])->dropDownList(range(1,31),['prompt'=>'дд','class'=>'form-control reg-select'])->label(false)?>
                    <?= $form->field($model,'bd_month',['options'=>['style'=>"width:103px;float:left;"]])->dropDownList(\common\helpers\HDates::monthsList(),['prompt'=>'мм','class'=>'form-control reg-select'])->label(false)?>
                    <?= $form->field($model,'bd_year',['options'=>['style'=>"width:61px;float:left;"]])->dropDownList(range(1970,2010),['prompt'=>'гггг','class'=>'form-control reg-select'])->label(false)?>
                    <?= $form->field($model,'birthday')->hiddenInput()->label(false)?>
                </div>
            </div>

            <div class="reg-buttons">
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                    <span id="step_1" class="reg-button next">
                      Далее
                    </span>
                </div>
            </div>
        </div>
        <div id="reg_2" class="registration second">
            <h1 class="reg-heading">
                <?=$this->title?>
            </h1>
            <span class="reg-text">
                  Укажите свой номер телефона и электронную почту<br/>
                  чтобы обеспечить максимальный уровень безопасности
                </span>

            <?= $form->field($model,'phone')->widget(\yii\widgets\MaskedInput::className(),[
                'mask' => '+7 (999) 999-99-99',
                'options'=>[
                    'class'=>'form-control reg-input',
                    'placeholder'=>'+7 (___) ___-__-__'
                ]
            ])->label(false)?>
            <?= $form->field($model,'email')->textInput(['class'=>'form-control reg-input','placeholder'=>'Ваш E-Mail'])->label(false)?>

            <div class="reg-buttons">
                <div class="col-md-4">
                    <span id="back" class="reg-button back">
                      Назад
                    </span>
                </div>
                <div class="col-md-6">
                    <?= Html::submitButton('Завершить регистрацию', ['class' => 'reg-button next', 'name' => 'signup-button']) ?>
                </div>
            </div>
        </div>
    </div>
<? ThemeForm::end(); ?>

<div class="col-md-6 col-xs-12 image-block hidden-xs">
    <img src="<?=Yii::getAlias('@static')?>/img/1_step.png" style="width: 100%"/>
</div>
</div>
