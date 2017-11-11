<?php

/* @var $this yii\web\View */
/* @var $form ThemeForm */
/* @var $model \common\models\User */
/* @var $userOwner \common\models\User */

use yii\helpers\Html;
use frontend\widgets\ThemeForm;
use yii\helpers\Url;

\frontend\assets\TagManagerAsset::register($this);

$isOwner = $model->id == $userOwner->id;

$this->title = $isOwner ? 'Моя страница' : 'Страница пользователя '.$model->fullName;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-panels col-md-12 col-lg-12 col-xs-12">

    <div class="col-md-10 col-lg-10 col-xs-12">
        <div class="col-md-12 col-lg-12 col-xs-12 myPage-block myPage-info edit-page">
            <span class="myPage-info__name">
                <?= $model->fullName; ?>
            </span>
            <div class="myPage-info__info clearfix">
                <div class="col-md-3">
                    <div class="row">
                          <span class="info-heading">
                            <img class="edit-image center-block" src="<?=Yii::getAlias('@static')?>/img/avatar.png">
                          </span>
                    </div>
                </div>
                <div class="col-md-9 col-xs-12 mb10">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <label class="edit-upload field prepend-icon file">
                                    <span class="button btn-primary">Выбрать</span>
                                    <input type="file" class="gui-file" name="file2" id="file2" onchange="document.getElementById('uploader2').value = this.value;">
                                    <input type="text" class="gui-input" id="uploader2" placeholder="Загрузите новое фото">
                                    <label class="field-icon">
                                        <i class="fa fa-upload"></i>
                                    </label>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $form = ThemeForm::begin([
                    'enableAjaxValidation' => true,
                    'validateOnBlur'       => true,
                ]); ?>
                <div class="col-md-9 col-xs-12 mb10">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="row">
                                <span class="info-heading">
                                    <?= ''?>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <?= $form->field($model,'status')->textInput(['placeholder'=>'Я сейчас...'])->label(false)?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 col-xs-12 mb10">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="row">
                          <span class="info-heading">
                            Класс
                          </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <?= $form->field($model->userInfo,'state')->dropDownList(\common\enums\UserCategory::getList())->label(false)?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 col-xs-12 mb10">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="row">
                          <span class="info-heading">
                            Профессия
                          </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <?= $form->field($model->userInfo,'prof')->textInput(['placeholder'=>'Например: Менеджер по продажам'])->label(false)?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 col-xs-12 mb10">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="row">
                          <span class="info-heading">
                            Интересы
                          </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <?= $form->field($model->userInfo,'interests')->textInput(['placeholder'=>'Например: Бокс, Еда...','class'=>'form-control tm-input'])->label(false)?>
                                <div class="tag-container tags"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 col-xs-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="row">
                          <span class="info-heading">
                            О себе
                          </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <?= $form->field($model->userInfo,'interests')->textarea(['class'=>'form-control textarea-grow'])->label(false)?>
                            </div>
                        </div>
                    </div>
                </div>

                <? ThemeForm::end(); ?>
            </div>
        </div>

        <div class="col-md-12 col-lg-12 col-xs-12 myPage-block myPage-social edit-page clearfix">
            <div class="col-md-12 col-xs-12 clearfix">
                <div class="row">
                    <div class="col-md-3">
                        <div class="row">
                      <span class="social-heading">
                        Социальные сети
                      </span>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xs-12 mb10">
                                <div class="col-md-2">
                                    <img class="vk social-img" src="<?=Yii::getAlias('@static')?>/img/vk-icon.png"/>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <input type="text" id="" class="edit-input form-control" placeholder="vk.com/id12345">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-12 col-xs-12 mb10">
                                <div class="col-md-2">
                                    <img class="fb social-img" src="<?=Yii::getAlias('@static')?>/img/fb-icon.png"/>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <input type="text" id="" class="edit-input form-control" placeholder="facebook.com/example">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 col-xs-12 mb10">
                                <div class="col-md-2">
                                    <img class="tw social-img" src="<?=Yii::getAlias('@static')?>/img/tw-icon.png"/>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <input type="text" id="" class="edit-input form-control" placeholder="twitter.com/example">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 col-xs-12 mb10">

                                <div class="col-md-2">
                                    <img class="social-img" src="<?=Yii::getAlias('@static')?>/img/ig-icon.png"/>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <input type="text" id="" class="edit-input form-control" placeholder="@example">
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-12 col-xs-12 mb30">
            <div class="row">
                <button class="edit-save pull-right">
                    Сохранить
                </button>
            </div>
        </div>

    </div>

</div>
