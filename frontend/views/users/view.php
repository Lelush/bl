<?php

/* @var $this yii\web\View */
/* @var $form ThemeForm */
/* @var $model \common\models\User */
/* @var $userOwner \common\models\User */
/* @var $users \common\models\User[] */

use yii\helpers\Html;
use frontend\widgets\ThemeForm;
use yii\helpers\Url;
use common\models\UserInfo;

$isOwner = $model->id == $userOwner->id;

$this->title = $isOwner ? 'Моя страница' : 'Страница пользователя '.$model->fullName;
$this->params['breadcrumbs'][] = $this->title;
$fakeUserInfo = new UserInfo();
?>
<div class="admin-panels col-md-12 col-lg-12 col-xs-12">

    <div class="col-md-3 col-lg-3 col-xs-12">
        <div class="col-md-8 center-block col-lg-10 col-xs-12 myPage-avatar">
            <div class="row">
                <img class="center-block thumbnail" src="<?= $model->userInfo->avatarSrc; ?>"/>
            </div>
        </div>
        <div class="col-md-8 center-block col-lg-10 col-xs-12 myPage-block myPage-stat mt20">
            <div class="row">
                <div class="col-md-9 col-xs-9 col-lg-9 myPage-stat__text">
                    <a class="myPage-stat" href="">
                        Статистика
                    </a>
                </div>
                <div class="col-md-3 col-xs-3 col-lg-3">
                    <a class="center-block myPage-settings" href="<?= Url::to(['/users/edit'])?>">
                        <img src="<?= Yii::getAlias('@static') ?>/img/settinngs.png"/>
                    </a>
                </div>
            </div>
        </div>

        <? if($model->friendUsers): ?>
        <div class="col-md-8 center-block col-lg-10 col-xs-12 myPage-block myPage-friends mt20">
            <div class="row">
                <div class="col-md-9 col-xs-9 col-lg-9 headline mb10">
                    Друзья
                </div>
                <div class="col-md-3 col-xs-3 col-lg-3">
                    <a class="all" href="<?= Url::to(['/users/my-friends'])?>">
                        Все
                    </a>
                </div>
                <div class="col-md-12 col-lg-12 col-xs-12 friends-list">
                    <div class="row">
                        <?foreach ($model->friendUsers as $friendUser):?>
                            <div class="col-md-4 col-lg-4 col-xs-4 friend-list_item">
                                <a href="<?= $friendUser->getViewUrl();?>">
                                    <img src="<?= $friendUser->userInfo ? $friendUser->userInfo->avatarSrc : $fakeUserInfo->avatarSrc; ?>"/>
                                    <span class="name"><?= $friendUser->first_name; ?></span>
                                </a>
                            </div>
                        <? endforeach; ?>


                    </div>
                </div>
            </div>
        </div>
        <? endif; ?>
    </div>

    <div class="col-md-9 col-lg-9 col-xs-12">
        <div class="row myPage-block myPage-info">
            <div class="col-md-12 col-lg-12 col-xs-12 ">
                    <span class="myPage-info__name">
                        <?= $model->fullName; ?>
                    </span>
                <div class="myPage-views">
                    <?= $model->views ?>
                </div>
                <div class="myPage-info__info clearfix">
                    <div class="col-md-12 col-xs-12 mb10">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="row">
                              <span class="info-heading">
                                Статус
                              </span>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <span>
                                        <?= $model->userInfo->state; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-xs-12 mb10">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="row">
                                    <span class="info-heading">
                                    Класс
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <span>
                                    <?= \common\enums\UserCategory::getValue($model->userInfo->scope)?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-xs-12 mb10">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="row">
                                    <span class="info-heading">
                                    Профессия
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <span>
                                    <?= $model->userInfo->prof; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-xs-12 mb10">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="row">
                              <span class="info-heading">
                                Интересы
                              </span>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                              <span>
                                <?= $model->userInfo->interests; ?>
                              </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-xs-12">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="row">
                              <span class="info-heading">
                                О себе
                              </span>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                              <span>
                                <?= $model->userInfo->about; ?>
                              </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row myPage-block myPage-social">
            <div class="col-md-12 col-xs-12 clearfix">
                <div class="row">
                    <div class="col-md-3">
                        <span class="social-heading">
                        Социальные сети
                        </span>
                    </div>
                    <div class="col-md-9">
                            <? if($model->userInfo->vk):?>
                            <a class="social-link" href="<?= $model->userInfo->vk; ?>">
                                <img class="vk social-img" src="<?=Yii::getAlias('@static')?>/img/vk-icon.png"/>
                            </a>
                            <? endif; ?>
                            <? if($model->userInfo->fb):?>
                            <a class="social-link" href="<?= $model->userInfo->fb; ?>">
                                <img class="fb social-img" src="<?=Yii::getAlias('@static')?>/img/fb-icon.png"/>
                            </a>
                            <? endif; ?>
                            <? if($model->userInfo->tw):?>
                            <a class="social-link" href="<?= $model->userInfo->tw; ?>">
                                <img class="tw social-img" src="<?=Yii::getAlias('@static')?>/img/tw-icon.png"/>
                            </a>
                            <? endif; ?>
                            <? if($model->userInfo->inst):?>
                            <a class="social-link" href="<?= $model->userInfo->inst; ?>">
                                <img class="social-img" src="<?=Yii::getAlias('@static')?>/img/ig-icon.png"/>
                            </a>
                            <? endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row myPage-block myPage-feed">
            <div class="col-md-12 col-lg-12 col-xs-12 ">
                <div class="feed-tabs">
                    <div class="feed-tabs_tab">
                                <span class="text">
                                Люди
                                </span>
                                <div data-feed="people-tab" class="tab-button active">
                                    <img src="<?=Yii::getAlias('@static')?>/img/users/people-tab.svg"/>
                                    <? if(false): /** @TODO ??? */?>
                                    <span>
                                      240
                                    </span>
                                    <? endif; ?>
                                </div>
                    </div>

                            <div class="feed-tabs_tab">
                          <span class="text">
                            Активность
                          </span>
                                <div data-feed="activity-tab" class="tab-button">
                                    <img src="<?=Yii::getAlias('@static')?>/img/users/activity-tab.svg"/>
                                    <? if(false): /** @TODO ??? */?>
                                    <span>
                                      8/10
                                    </span>
                                    <? endif; ?>
                                </div>
                            </div>

                            <div class="feed-tabs_tab">
                          <span class="text">
                            Медиа
                          </span>
                                <div data-feed="media-tab" class="tab-button">
                                    <img src="<?=Yii::getAlias('@static')?>/img/users/media-tab.svg"/>
                                    <? if(false): /** @TODO ??? */?>
                                    <span>
                                      25
                                    </span>
                                    <? endif; ?>
                                </div>
                            </div>

                            <div class="feed-tabs_tab">
                          <span class="text">
                            Места
                          </span>
                                <div data-feed="places-tab" class="tab-button">
                                    <img src="<?=Yii::getAlias('@static')?>/img/users/places-tab.svg"/>
                                    <? if(false): /** @TODO ??? */?>
                                    <span>
                                      150
                                    </span>
                                    <? endif; ?>
                                </div>
                            </div>

                    <div class="feed-tabs_tab">
                        <span class="text">
                            Предложения
                        </span>
                        <div data-feed="offers-tab" class="tab-button">
                            <img src="<?=Yii::getAlias('@static')?>/img/users/offers-tab.svg"/>
                                <span>15</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="feed-content col-xs-12 col-md-12 col-lg-12">
                        <div id="people-tab" class="feed-content_box people mt20">
                            <div class="row">
                                <div class="people-tabs col-xs-12 col-md-12 col-lg-12">
                                    <span class="people-tabs_tab">
                                        Люди
                                    </span>
                                    <span class="people-tabs_tab active">
                                        Друзья
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <? foreach($users as $user): ?>
                                <div class="col-md-6">
                                    <div class="people-items_item">
                                        <div class="col-md-2 item-avatar">
                                            <a href="<?= $user->getViewUrl(); ?>">
                                                <img src="<?= $user->userInfo->getAvatarSrc();?>"/>
                                            </a>
                                        </div>
                                        <div class="col-md-10 item-info">
                                            <span class="col-md-12 name">
                                                <a href="<?= $user->getViewUrl(); ?>">
                                                    <?= $user->fullName;?>
                                                </a>
                                            </span>
                                            <? if($user->userInfo->state): ?>
                                            <span class="col-md-12 status">
                                                  <?= $user->userInfo->state?>
                                            </span>
                                            <? endif; ?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button class="item-action" onclick="return Profile.toggleFriend(this,<?=$user->id;?>)">
                                                        Пригласить
                                                    </button>
                                                </div>
                                                <!--<div class="col-md-6">
                                                    <button class="item-action">
                                                        Написать
                                                    </button>
                                                </div>-->
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <? endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
