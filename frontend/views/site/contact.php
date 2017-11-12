<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Обновления';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="admin-panels">

    <div class="col-md-12 col-xs-12">
        <h1 class="reg-heading">
            <?=$this->title?>
        </h1>
        <div class="updates-tabs">
                  <span id="first-tab" class="active">
                    Предложить обновление
                  </span>
            <span id="second-tab">
                    Выпущенные обновления
                  </span>
        </div>
        <h1 class="reg-heading">
            Мои идеи
        </h1>
        <span class="reg-text">
                  BL - это сеть, которую создают сами пользователи, создавая свое собственное
                  пространство, имеющее все возможности, которые были бы вам необходимы
                </span>
        <span class="reg-text">
                  Мы позволяем людям самим создавать продукт, который поможет в решении их задач
                  и достижении поставленных целей.<br/>
                  Расскажи как ты видишь социальную сеть будущего и получи возможность <b>выиграть автомобиль</b> и стать частью команды BL!
                </span>
    </div>

    <div class="col-xs-12 image-block-updates hidden-md hidden-lg">
        <div class="image-text">
            Социальная сеть,<br/>
            которую создаешь ты
        </div>
    </div>

    <div class="col-md-12 col-xs-12 update-form">
        <div class="col-md-8 col-xs-12">
            <?php $form = ActiveForm::begin(['id' => 'updates-form']); ?>
                <?= $form->errorSummary($model);?>
                <div class="updater-avatar col-md-2 col-xs-3">
                    <img src=""/>
                </div>
                <div class="updater-text col-md-10 col-xs-9">
                    <div class="update-textarea">
                        <?= $form->field($model, 'body')->textarea(['rows' => 6,'placeholder'=>'Создайте свое предложени'])->label(false) ?>
                        <div class="actions">
                            <img src="http://bl.2dsd.ru/new/assets/img/form-element_2.png">
                            <img src="http://bl.2dsd.ru/new/assets/img/form-element_4.png">
                            <img src="http://bl.2dsd.ru/new/assets/img/form-element_3.png">
                            <img src="http://bl.2dsd.ru/new/assets/img/form-element_1.png">
                        </div>
                    </div>
                </div>
                <div class="update-buttons col-md-4 col-xs-12 col-sm-12">
                    <span class="col-xs-12 hidden-md hidden-lg">
                    Напишите нам как вы видите социальную сеть будущего
                    </span>
                    <?= Html::submitButton('Добавить', ['class' => 'update-button', 'name' => 'add']) ?>
                    <span class="col-xs-12 hidden-md hidden-lg">
                    Напишите нам что бы вы изменили в действующей социальной сети BL
                    </span>
                    <?= Html::submitButton('Изменить', ['class' => 'update-button', 'name' => 'change']) ?>
                    <span class="col-xs-12 hidden-md hidden-lg">
                    Предложите новую функцию, которая облегчит и даст вам преимущества в
                    использовании социальной сети
                    </span>
                    <?= Html::submitButton('Предложить', ['class' => 'update-button', 'name' => 'suggest']) ?>
                    <span class="col-xs-12 hidden-md hidden-lg">
                        Напишите нам как бы вы усоврешенствовали социальную сеть нового поколения
                    </span>
                    <?= Html::submitButton('Дополнить', ['class' => 'update-button', 'name' => 'complete']) ?>
                </div>
            <? ActiveForm::end(); ?>
            <div class="update-buttons-text col-md-8 col-xs-12 hidden-xs hidden-sm">
                  <span>
                    Напишите нам как вы видите социальную сеть будущего
                  </span>
                <span>
                    Напишите нам что бы вы изменили в действующей социальной сети BL
                  </span>
                <span class="pt0">
                    Предложите новую функцию, которая облегчит и даст вам преимущества в
                    использовании социальной сети
                  </span>
                <span class="pt0">
                    Напишите нам как бы вы усоврешенствовали социальную сеть нового поколения
                  </span>
            </div>
        </div>

        <div class="col-md-4 col-xs-12 image-block-updates hidden-sm hidden-xs">
            <div class="image-text">
                Социальная сеть,<br/>
                которую создаешь ты
            </div>
        </div>
    </div>


</div>