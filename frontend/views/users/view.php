<?php

/* @var $this yii\web\View */
/* @var $form ThemeForm */
/* @var $model \common\models\User */
/* @var $userOwner \common\models\User */

use yii\helpers\Html;
use frontend\widgets\ThemeForm;
use yii\helpers\Url;

$isOwner = $model->id == $userOwner->id;

$this->title = $isOwner ? 'Моя страница' : 'Страница пользователя '.$model->fullName;
$this->params['breadcrumbs'][] = $this->title;
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

        <div class="col-md-8 center-block col-lg-10 col-xs-12 myPage-block myPage-friends mt20">
            <div class="row">
                <div class="col-md-9 col-xs-9 col-lg-9 headline mb10">
                    Друзья
                </div>
                <div class="col-md-3 col-xs-3 col-lg-3">
                    <a class="all" href="<?= Url::to(['/users/friends'])?>">
                        Все
                    </a>
                </div>
                <div class="col-md-12 col-lg-12 col-xs-12 friends-list">
                    <div class="row">

                        <div class="col-md-4 col-lg-4 col-xs-4 friend-list_item">
                            <div class="row">
                                <img src="<?=Yii::getAlias('@static')?>/img/users/friend-1.png"/>
                                <span class="name">
                        Мария
                      </span>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-4 friend-list_item">
                            <div class="row">
                                <img src="<?=Yii::getAlias('@static')?>/img/users/friend-2.png"/>
                                <span class="name">
                        Анастасия
                      </span>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-4 friend-list_item">
                            <div class="row">
                                <img src="<?=Yii::getAlias('@static')?>/img/users/friend-3.png"/>
                                <span class="name">
                        Виктория
                      </span>
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-4 col-xs-4 friend-list_item">
                            <div class="row">
                                <img src="<?=Yii::getAlias('@static')?>/img/users/friend-1.png"/>
                                <span class="name">
                          Екатерина
                        </span>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-4 friend-list_item">
                            <div class="row">
                                <img src="<?=Yii::getAlias('@static')?>/img/users/friend-2.png"/>
                                <span class="name">
                          Марина
                        </span>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-4 friend-list_item">
                            <div class="row">
                                <img src="<?=Yii::getAlias('@static')?>/img/users/friend-3.png"/>
                                <span class="name">
                          Умида
                        </span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-9 col-lg-9 col-xs-12">
        <div class="row myPage-block myPage-info">
            <div class="col-md-12 col-lg-12 col-xs-12 ">
                    <span class="myPage-info__name">
                        <?= $model->fullName; ?>
                    </span>
                <div class="myPage-views">
                    120
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
                                    <span>
                              240
                            </span>
                                </div>
                            </div>

                            <div class="feed-tabs_tab">
                          <span class="text">
                            Активность
                          </span>
                                <div data-feed="activity-tab" class="tab-button">
                                    <img src="<?=Yii::getAlias('@static')?>/img/users/activity-tab.svg"/>
                                    <span>
                              8/10
                            </span>
                                </div>
                            </div>

                            <div class="feed-tabs_tab">
                          <span class="text">
                            Медиа
                          </span>
                                <div data-feed="media-tab" class="tab-button">
                                    <img src="<?=Yii::getAlias('@static')?>/img/users/media-tab.svg"/>
                                    <span>
                              25
                            </span>
                                </div>
                            </div>

                            <div class="feed-tabs_tab">
                          <span class="text">
                            Места
                          </span>
                                <div data-feed="places-tab" class="tab-button">
                                    <img src="<?=Yii::getAlias('@static')?>/img/users/places-tab.svg"/>
                                    <span>
                              150
                            </span>
                                </div>
                            </div>

                            <div class="feed-tabs_tab">
                          <span class="text">
                            Предложения
                          </span>
                                <div data-feed="offers-tab" class="tab-button">
                                    <img src="<?=Yii::getAlias('@static')?>/img/users/offers-tab.svg"/>
                                    <span>
                              15
                            </span>
                                </div>
                            </div>
                        </div>

                        <div class="feed-content col-xs-12 col-md-12 col-lg-12">
                            <div id="people-tab" class="feed-content_box people mt20">
                                <div class="row">
                                    <div class="people-tabs col-xs-12 col-md-12 col-lg-12">
                                        <div class="row">
                                <span class="people-tabs_tab">
                                  Люди
                                </span>
                                            <span class="people-tabs_tab active">
                                  Друзья
                                </span>
                                        </div>
                                    </div>

                                    <div class="people-items col-xs-12 col-md-12 col-lg-12">
                                        <div class="row">
                                            <div class="people-items_item col-md-5">
                                                <div class="col-md-2 item-avatar">
                                                    <img src="<?=Yii::getAlias('@static')?>/img/users/friend-1.png"/>
                                                </div>
                                                <div class="col-md-10 item-info">
                                    <span class="col-md-12 name">
                                      Мария Воробьева
                                    </span>
                                                    <span class="col-md-12 status">
                                      Ищу новые знакомства
                                    </span>
                                                    <button class="col-md-5 item-action">
                                                        Пригласить
                                                    </button>
                                                    <button class="col-md-5 item-action">
                                                        Написать
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="people-items_item col-md-5">
                                                <div class="col-md-2 item-avatar">
                                                    <img src="<?=Yii::getAlias('@static')?>/img/users/friend-1.png"/>
                                                </div>
                                                <div class="col-md-10 item-info">
                                    <span class="col-md-12 name">
                                      Екатерина Вахитова
                                    </span>
                                                    <span class="col-md-12 status">
                                      Открыта к общению
                                    </span>
                                                    <button class="col-md-5 item-action">
                                                        Пригласить
                                                    </button>
                                                    <button class="col-md-5 item-action">
                                                        Написать
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="people-items_item col-md-5">
                                                <div class="col-md-2 item-avatar">
                                                    <img src="<?=Yii::getAlias('@static')?>/img/users/friend-1.png"/>
                                                </div>
                                                <div class="col-md-10 item-info">
                                    <span class="col-md-12 name">
                                      Умида Нургазиева
                                    </span>
                                                    <span class="col-md-12 status">
                                      В поисках пары
                                    </span>
                                                    <button class="col-md-5 item-action">
                                                        Пригласить
                                                    </button>
                                                    <button class="col-md-5 item-action">
                                                        Написать
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="people-items_item col-md-5">
                                                <div class="col-md-2 item-avatar">
                                                    <img src="<?=Yii::getAlias('@static')?>/img/users/friend-1.png"/>
                                                </div>
                                                <div class="col-md-10 item-info">
                                    <span class="col-md-12 name">
                                      Светлана Кочеткова
                                    </span>
                                                    <span class="col-md-12 status">
                                      Кто со мной в кино?
                                    </span>
                                                    <button class="col-md-5 item-action">
                                                        Пригласить
                                                    </button>
                                                    <button class="col-md-5 item-action">
                                                        Написать
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="activity-tab" class="feed-content_box activity mt20">
                                Активность
                            </div>
                            <div id="media-tab" class="feed-content_box media mt20">
                                Медиа
                            </div>
                            <div id="places-tab" class="feed-content_box places mt20">
                                Места
                            </div>
                            <div id="offers-tab" class="feed-content_box offers mt20">
                                Предложения
                            </div>
                        </div>
            </div>
        </div>
    </div>

</div>
