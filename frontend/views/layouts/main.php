<?php

/* @var $this \yii\web\View */

/* @var $content string */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use frontend\components\CNavBar;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <?php $this->registerLinkTag(['rel' => 'shortcut icon', 'href' => '/img/favicon.ico']) ?>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="sb-l-o sb-r-c">
<?php $this->beginBody() ?>
<div class="menu-overlay"></div>

<div class="video-overlay">
  <span id="videoPop-up_close">
    <i class="fa fa-close"></i>
  </span>
    <div class="video-desktop hidden-xs hidden-sm">
        <video id="video2" src="video.mov"></video>
        <button id="play-Pause2"><i id="pP-icon2" class="fa fa-play" aria-hidden="true"></i></button>
    </div>
</div>

<!-- Start: Main -->
<div id="main">

    <!-- Start: Header -->
    <?php
    CNavBar::begin([
        'brandLabel' => 'Выбери свое будущее',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'tag' => 'header',
            'class' => 'navbar-fixed-top bg-dark',
        ],
        'type' => Yii::$app->user->isVirtualMode() ? CNavBar::TYPE_WARNING : null
    ]);
    //        echo '<p class="navbar-text">Баланс: 100р. '.Html::a('Пополнить', ['/site/balance']).'</p>';
    $menuItems = [
        [
            'label' => 'Уведомления',
            'url' => ['/site/notice'],
            'badge' => [
                'count' => 3,
                'type' => 'danger'
            ]
        ],
        /*[
            'label' => 'Поддержка',
            'url' => ['/site/support'],

        ],
        [
            'label' => 'Права доступа',
            'url' => ['/site/rbac'],
        ],
        [
            'icon' => [
                'name' => 'glyphicon glyphicon-cog',

            ],
            'url' => ['/site/settings']
        ],*/


    ];
    //    if (Yii::$app->user->isGuest) {
    //        $menuItems[] = [
    //            'icon' => [
    //                'name' => 'glyphicon glyphicon-log-in',
    //
    //            ],
    //            'url' => ['/site/login']
    //        ];
    //    } elseif(Yii::$app->user->isVirtualMode()) {
    //        $menuItems[] = [
    //            'label' => isset($this->getUser()->username) ? $this->getUser()->username: '',
    //            'items' => [
    //                [
    //                    'icon' => [
    //                        'name' => 'glyphicon glyphicon-log-out',
    //                    ],
    //                    'label' => 'Завершить виртуальный режим',
    //                    'url' => ['/site/virtual-logout'],
    //                    'linkOptions' => ['data-method' => 'post'],
    //                    'options' => [
    //                        'class' => 'dropdown-footer ',
    //                    ],
    //                ]
    //            ]
    //        ];
    //    }else {
    //        $menuItems[] = [
    //            'label' => isset($this->getUser()->username) ? $this->getUser()->username: '',
    //            'items' => [
    //                [
    //                    'icon' => [
    //                        'name' => 'glyphicon glyphicon-log-out',
    //
    //                    ],
    //                    'label' => 'Выход',
    //                    'url' => ['/site/logout'],
    //                    'linkOptions' => ['data-method' => 'post'],
    //                    'options' => [
    //                        'class' => 'dropdown-footer',
    //                    ],
    //                ]
    //            ]
    //        ];
    //    }

    //    echo CNav::widget([
    //        'options' => ['class' => 'navbar-nav navbar-right'],
    //        'items' => $menuItems,
    //    ]);
    ?>
    <ul class="nav navbar-nav navbar-right">
        <li class="header-li">
            <a class="tray-notication" href="#">
                <img src="<?= Yii::getAlias('@static') ?>/img/rocket-icon.svg">
                <span class="sidebar-title-tray">
                <span class="label label-xs label-rounded bg-danger">1</span>
              </span>
            </a>
        </li>
        <li class="dropdown header-li">
            <a class="dropdown-toggle tray-notication" data-toggle="dropdown" href="#">
                <img src="<?= Yii::getAlias('@static') ?>/img/bell-icon.svg">
                <span class="sidebar-title-tray">
                <span class="label label-xs label-rounded bg-danger">4</span>
              </span>
            </a>
            <ul class="dropdown-menu media-list w350 animated animated-shorter fadeIn" role="menu">
                <li class="dropdown-header">
                    <span class="dropdown-title"> Уведомления</span>
                    <span class="label label-warning">12</span>
                </li>
                <li class="media">
                    <a class="media-left" href="#"> <img src="/img/avatars/5.jpg" class="mw40" alt="avatar"> </a>
                    <div class="media-body">
                        <h5 class="media-heading">Новость
                            <small class="text-muted">- 08/16/22</small>
                        </h5>
                        Обновлена 36 дней назад
                        <a class="text-system" href="#"> Max </a>
                    </div>
                </li>
                <li class="media">
                    <a class="media-left" href="#"> <img src="/img/avatars/2.jpg" class="mw40" alt="avatar"> </a>
                    <div class="media-body">
                        <h5 class="media-heading">Новость
                            <small class="text-muted">- 08/16/22</small>
                        </h5>
                        Обновлена 36 дней назад
                        <a class="text-system" href="#"> Max </a>
                    </div>
                </li>
                <li class="media">
                    <a class="media-left" href="#"> <img src="/img/avatars/3.jpg" class="mw40" alt="avatar"> </a>
                    <div class="media-body">
                        <h5 class="media-heading">Новость
                            <small class="text-muted">- 08/16/22</small>
                        </h5>
                        Обновлена 36 дней назад
                        <a class="text-system" href="#"> Max </a>
                    </div>
                </li>
                <li class="media">
                    <a class="media-left" href="#"> <img src="/img/avatars/4.jpg" class="mw40" alt="avatar"> </a>
                    <div class="media-body">
                        <h5 class="media-heading">Новость
                            <small class="text-muted">- 08/16/22</small>
                        </h5>
                        Обновлена 36 дней назад
                        <a class="text-system" href="#"> Max </a>
                    </div>
                </li>
            </ul>
        </li>
        <li class="top-people hidden-xs">
            <a href="#" class="fw600 p10">
                <img src="<?= Yii::getAlias('@static') ?>/img/top-people/top.svg" alt="" style="margin-right: 15px">
                <img src="/img/avatars/1.jpg" alt="avatar" class="mw40 br64 mr15">
                <img src="/img/avatars/1.jpg" alt="avatar" class="mw40 br64 mr15">
                <img src="/img/avatars/1.jpg" alt="avatar" class="mw40 br64 mr15">
                <img src="/img/avatars/1.jpg" alt="avatar" class="mw40 br64 mr15">
            </a>
        </li>
        <li class="top-places hidden-xs">
          <span>
            <img src="<?= Yii::getAlias('@static') ?>/img/marker.svg"/>
            Лучшие места
          </span>
            <span>
            Москва
          </span>
        </li>
        <li class="dropdown header-li">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                RUS
                <i class="icon-angle-down"></i>
            </a>
            <ul class="dropdown-menu pv5 animated animated-short flipInX" role="menu">
                <li>
                    <a href="javascript:void(0);">
                        <span class="flag-xs flag-in mr10"></span> English </a>
                </li>
                <li>
                    <a href="javascript:void(0);">
                        <span class="flag-xs flag-tr mr10"></span> Russian </a>
                </li>
            </ul>
        </li>
    </ul>
    <?
    CNavBar::end();
    ?>

    <!-- End: Header -->

    <!-- Start: Sidebar Left -->
    <aside id="sidebar_left" class="nano affix nano-primary">

        <!-- Start: Sidebar Left Content -->
        <div class="sidebar-left-content nano-content">

            <!-- Start: Sidebar Left Menu -->
            <ul class="nav sidebar-menu">
                <? if(Yii::$app->getUser()->isGuest): ?>
                <div class="page-leftbar__login">
                    <a href="<?= Url::to(['/site/login'])?>" class="page-leftbar__login-wrap">
                        <div class="page-leftbar__login__avatar">
                            <img src="<?= Yii::getAlias('@static') ?>/img/avatar.svg" alt="">
                        </div>
                        <div class="page-leftbar__login__avatar-border"></div>
                        <span class="login-text">Войти</span>
                    </a>
                </div>
                <? endif; ?>
                <? if(!Yii::$app->getUser()->isGuest): ?>
                <li>
                    <a href="<?= Url::to(['/users/my-page'])?>">
                        <span>
                            <img src="<?= Yii::getAlias('@static') ?>/img/left-nav/crown.svg" alt="">
                        </span>
                        <span class="sidebar-title">Моя страница</span>
                    </a>
                </li>
                <? endif; ?>
                <li>
                    <a href="#">
                        <span><img src="<?= Yii::getAlias('@static') ?>/img/left-nav/news.svg" alt=""></span>
                        <span class="sidebar-title">Новости</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span><img src="<?= Yii::getAlias('@static') ?>/img/left-nav/user.svg" alt=""></span>
                        <span class="sidebar-title">Друзья</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span>
                        <img src="<?= Yii::getAlias('@static') ?>/img/left-nav/message.svg" alt="">
                        </span>
                        <span class="sidebar-title">Сообщения</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span>
                        <img src="<?= Yii::getAlias('@static') ?>/img/left-nav/bell.svg" alt="">
                        </span>
                        <span class="sidebar-title">Уведомления</span>
                        <span class="sidebar-title-tray">
                            <span class="label label-xs label-rounded bg-danger">1</span>
                        </span>
                    </a>
                </li>

                <hr/>

                <li>
                    <a href="#">
                        <span>
                        <img src="<?= Yii::getAlias('@static') ?>/img/left-nav/marker.svg" alt="">
                        </span>
                        <span class="sidebar-title">Карта</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span>
                        <img src="<?= Yii::getAlias('@static') ?>/img/left-nav/star.svg" alt="">
                        </span>
                        <span class="sidebar-title">Лучшие места</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span>
                        <img src="<?= Yii::getAlias('@static') ?>/img/left-nav/lightning.svg" alt="">
                        </span>
                        <span class="sidebar-title">Возможности</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span>
                        <img src="<?= Yii::getAlias('@static') ?>/img/left-nav/diamond.svg" alt="">
                        </span>
                        <span class="sidebar-title">Вознаграждения</span>
                    </a>
                </li>
                <li>
                    <a href="http://bl.2dsd.ru/new/updates.html">
                        <span>
                            <img src="<?= Yii::getAlias('@static') ?>/img/left-nav/chat.svg" alt="">
                        </span>
                        <span class="sidebar-title">Обновления</span>
                    </a>
                </li>

                <hr/>

                <li>
                    <a href="#">
                        <span><img src="<?= Yii::getAlias('@static') ?>/img/left-nav/plus.svg" alt=""></span>
                        <span class="sidebar-title">Пригласить друга</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span><img src="<?= Yii::getAlias('@static') ?>/img/left-nav/settings.svg" alt=""></span>
                        <span class="sidebar-title">Настройки</span>
                    </a>
                </li>
                <li>
                    <a href="http://bl.2dsd.ru/new/terms.html">
                        <span><img src="<?= Yii::getAlias('@static') ?>/img/left-nav/docs.svg" alt=""></span>
                        <span class="sidebar-title">Правила</span>
                    </a>
                </li>
                <? if(Yii::$app->getUser()->getIsGuest()):?>
                <li class="bl_button">
                    <a href="<?= Url::to(['/site/signup'])?>">
                        <span class="hidden-md hidden-lg hidden-xs">
                            <img class="hidden-md hidden-lg" src="<?= Yii::getAlias('@static') ?>/img/login-button-mobile.svg">
                        </span>
                        <span class="sidebar-title hidden-sm">Зарегистрироваться</span>
                    </a>
                </li>
                <? endif; ?>

                <!-- sidebar progress bars -->
                <li class="sidebar-stat hidden">
                    <a href="#projectOne" class="fs11">
                        <span class="fa fa-inbox text-info"></span>
                        <span class="sidebar-title text-muted">Email Storage</span>
                        <span class="pull-right mr20 text-muted">35%</span>
                        <div class="progress progress-bar-xs mh20 mb10">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="45"
                                 aria-valuemin="0" aria-valuemax="100" style="width: 35%">
                                <span class="sr-only">35% Complete</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="sidebar-stat hidden">
                    <a href="#projectOne" class="fs11">
                        <span class="fa fa-dropbox text-warning"></span>
                        <span class="sidebar-title text-muted">Bandwidth</span>
                        <span class="pull-right mr20 text-muted">58%</span>
                        <div class="progress progress-bar-xs mh20">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45"
                                 aria-valuemin="0" aria-valuemax="100" style="width: 58%">
                                <span class="sr-only">58% Complete</span>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- End: Sidebar Menu -->
        </div>
        <!-- End: Sidebar Left Content -->

    </aside>
    <!-- End: Sidebar Left -->

    <!-- Start: Content-Wrapper -->
    <section id="content_wrapper">

        <!-- Begin: Content -->
        <section id="content" class="animated">

            <?= Alert::widget() ?>

            <?= $content; ?>

        </section>
        <!-- End: Content -->

    </section>
    <!-- End: Content-Wrapper -->

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
