<?php

/* @var $this yii\web\View */
/* @var $form ThemeForm */
/* @var $model \frontend\models\UserForm */
/* @var $userOwner \common\models\User */

use yii\helpers\Html;
use frontend\widgets\ThemeForm;
use yii\helpers\Url;

\frontend\assets\TagManagerAsset::register($this);

$isOwner = $model->id == $userOwner->id;

$this->title = $isOwner ? 'Моя страница' : 'Страница пользователя '.$model->fullName;
$this->params['breadcrumbs'][] = $this->title;
$interests = $model->modelUserInfo->interestsJson;
$tagManagerName = Html::getInputName($model->modelUserInfo,'interests');
$this->registerJs(<<<JS
    $(".tm-input").tagsManager({
        tagsContainer: '.tags',
        prefilled: $interests,
        tagClass: 'tm-tag-info',
        hiddenTagListName: '$tagManagerName',
    });
JS
);
?>
<div class="admin-panels col-md-12 col-lg-12 col-xs-12">
    <?php $form = ThemeForm::begin([
        'enableAjaxValidation' => true,
        'validateOnBlur'       => true,
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>
    <div class="col-md-10 col-lg-10 col-xs-12">
        <div class="col-md-12 col-lg-12 col-xs-12 myPage-block myPage-info edit-page">
            <span class="myPage-info__name">
                <?= $model->fullName; ?>
            </span>
            <div class="myPage-info__info clearfix">

                <?php echo $form->field($model->modelUserInfo, 'avatar')->widget(\frontend\widgets\cropper\Widget::className(), [
                    'uploadUrl' => Url::toRoute('/users/uploadPhoto'),
                    'noPhotoImage' => Yii::getAlias('@static/images/user/default_avatar.jpg'),
                    'pluginOptions' =>[
                        'aspectRatio' => 1
                    ],
                    'thumbnailWidth' => 186,
                    'thumbnailHeight' => 186,
                    'cropAreaWidth' => 372,
                    'cropAreaHeight' => 372,
                    'width' => 186,
                    'height' => 186,
                    'onCompleteJcrop' => 'function(imgName, response, widget){
                        $(widget).find(".edit-upload").click();
                        
                    }'
                ])->label(false) ?>

                <?= $form->field($model,'id')->hiddenInput()->label(false)?>


                <div class="col-md-9 col-xs-12 mb10">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="row">
                                <span class="info-heading">
                                    <?= 'Статус'?>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <?= $form->field($model->modelUserInfo,'state')->textInput(['placeholder'=>'Я сейчас...'])->label(false)?>
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
                                <?= $form->field($model->modelUserInfo,'scope')->dropDownList(\common\enums\UserCategory::getList())->label(false)?>
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
                                <?= $form->field($model->modelUserInfo,'prof')->textInput(['placeholder'=>'Например: Менеджер по продажам'])->label(false)?>
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
                                <?= $form->field($model->modelUserInfo,'interests')->textInput(['placeholder'=>'Например: Бокс, Еда...','class'=>'form-control tm-input'])->label(false)?>
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
                                <?= $form->field($model->modelUserInfo,'about')->textarea(['class'=>'form-control textarea-grow', 'rows'=>4])->label(false)?>
                            </div>
                        </div>
                    </div>
                </div>


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
                                        <?= $form->field($model->modelUserInfo,'vk')->textInput(['placeholder'=>'vk.com/id12345'])->label(false)?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-12 col-xs-12 mb10">
                                <div class="col-md-2">
                                    <img class="fb social-img" src="<?=Yii::getAlias('@static')?>/img/fb-icon.png"/>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <?= $form->field($model->modelUserInfo,'fb')->textInput(['placeholder'=>'facebook.com/example'])->label(false)?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 col-xs-12 mb10">
                                <div class="col-md-2">
                                    <img class="tw social-img" src="<?=Yii::getAlias('@static')?>/img/tw-icon.png"/>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <?= $form->field($model->modelUserInfo,'tw')->textInput(['placeholder'=>'twitter.com/example'])->label(false)?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 col-xs-12 mb10">

                                <div class="col-md-2">
                                    <img class="social-img" src="<?=Yii::getAlias('@static')?>/img/ig-icon.png"/>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <?= $form->field($model->modelUserInfo,'inst')->textInput(['placeholder'=>'@example'])->label(false)?>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-12 col-xs-12 mb30">
            <div class="form-group pull-right">
                <?= Html::a('Отмена',['/my-page'], ['class' => 'btn btn-default']) ?>
                <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => 'btn edit-save']) ?>
            </div>
        </div>

    </div>
    <? ThemeForm::end(); ?>
</div>
