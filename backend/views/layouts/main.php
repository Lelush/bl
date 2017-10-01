<?php

/* @var $this \backend\components\View */
/* @var $content string */

use common\enums\Role;
use common\widgets\Alert;
use backend\assets\AppAsset;
use backend\components\CBreadcrumbs;
use backend\components\CLeftNav;
use backend\components\CLeftNavBar;
use backend\components\CNav;
use backend\components\CNavBar;
use yii\helpers\Html;

AppAsset::register($this);

$js = <<<SCRIPT
$(function () {
    $("[data-toggle='tooltip']").tooltip();
});;
$(function () {
    $("[data-toggle='popover']").popover();
});
var globalThrobber = $("#global-throbber-backgroud");

$(document).on('pjax:beforeSend', function(){
    globalThrobber.show();
});
$(document).on('pjax:success',function(){
    globalThrobber.hide();
});
SCRIPT;
$this->registerJs($js);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> - <?= Yii::$app->name; ?></title>
    <!-- Font CSS (Via CDN) -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600'>
    <?php $this->head() ?>
</head>

<body class="dashboard-page sb-l-o sb-r-c">
<?php $this->beginBody() ?>

<!-- Start: Main -->
<div id="main">

    <!-- Start: Header -->
    <?php
    CNavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'tag' => 'header',
            'class' => 'navbar-fixed-top',
        ],
        'type' => Yii::$app->user->isVirtualMode() ? CNavBar::TYPE_WARNING : null
    ]);
    //        echo '<p class="navbar-text">Баланс: 100р. '.Html::a('Пополнить', ['/site/balance']).'</p>';
    $menuItems = [
        /*[
            'label' => 'Поддержка',
            'url' => ['/site/support'],

        ],
        [
            'label' => 'Уведомления',
            'url' => ['/site/notice'],
            'badge' => [
                'count' => 3,
                'type' => 'danger'
            ]
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
    if (Yii::$app->user->isGuest) {
        $menuItems[] = [
            'icon' => [
                'name' => 'glyphicon glyphicon-log-in',

            ],
            'url' => ['/site/login']
        ];
    } elseif(Yii::$app->user->isVirtualMode()) {
        $menuItems[] = [
            'label' => isset($this->getUser()->username) ? $this->getUser()->username: '',
            'items' => [
                [
                    'icon' => [
                        'name' => 'glyphicon glyphicon-log-out',
                    ],
                    'label' => 'Завершить виртуальный режим',
                    'url' => ['/site/virtual-logout'],
                    'linkOptions' => ['data-method' => 'post'],
                    'options' => [
                        'class' => 'dropdown-footer ',
                    ],
                ]
            ]
        ];
    }else {
        $menuItems[] = [
            'label' => isset($this->getUser()->username) ? $this->getUser()->username: '',
            'items' => [
                [
                    'icon' => [
                        'name' => 'glyphicon glyphicon-log-out',

                    ],
                    'label' => 'Выход',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post'],
                    'options' => [
                        'class' => 'dropdown-footer',
                    ],
                ]
            ]
        ];
    }

    echo CNav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    CNavBar::end();
    ?>

    <!-- End: Header -->
    <!-- Start: Sidebar Left -->
    <?php
    CLeftNavBar::begin();
    $leftMenuItems = [
//        [
//            'icon' => [
//                'name' => 'fa fa-users',
//            ],
//            'label' => 'Рекламодатели',
//            'url' => ['company/advertiser'],
//            'visible' => Yii::$app->user->getIdentity()->role == Role::ADMIN,
//        ],
        [
            'icon' => [
                'name' => 'fa fa-edit',
            ],
            'label' => 'Администрирование',
            'url' => ['#'],
            'visible' => Yii::$app->user->getIdentity()->role == Role::ADMIN,
            'items' => [
                [
                    'icon' => [
                        'name' => 'fa fa-users',
                    ],
                    'label' => 'Пользователи',
                    'url' => ['users/index'],
                ],
                [
                    'icon' => [
                        'name' => 'fa fa-build',
                    ],
                    'label' => 'Компании',
                    'url' => ['company/index'],
                ],
            ],
        ],
        [
            'icon'  => [
                'name' => 'fa fa-calendar',
            ],
            'label' => 'Мой профиль',
            'url'   => ['/company/my-profile'],
            'visible' => !Yii::$app->user->can(Role::ADMIN)
        ]

    ];
    echo CLeftNav::widget([
        'options' => ['class' => 'sidebar-menu'],
        'items' => $leftMenuItems,
    ]);
    CLeftNavBar::end();
    ?>
    <!-- End: Sidebar Left -->

    <!-- Start: Content-Wrapper -->
    <section id="content_wrapper">
        <div id="global-throbber-backgroud">
            <div id="global-throbber"><?=Html::img("@static/img/loading_big.gif")?></div>
        </div>
        <!-- Start: Topbar -->
        <?= CBreadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : ['label'=>'Home'],
        ]) ?>
        <!-- End: Topbar -->

        <!-- Begin: Content -->
        <section id="content" class="pt10 animated fadeIn">
            <? if($this->showTitle):?>
                <h2 class="mb20 mt10"><?= $this->title?></h2>
            <? endif; ?>
            <?= Alert::widget() ?>

            <?= $content ?>


        </section>
        <!-- End: Content -->

        <!-- Begin: Page Footer -->
        <footer id="content-footer" class="affix">
            <div class="row">
                <div class="col-md-6">
                    <span class="footer-legal">Copyright &copy; 2012-<?= date('Y') ?> by <?=Html::a('Masterlead','http://masterlead.ru/',['target'=>'_blank'])?>. All Rights Reserved.</span>
                </div>
                <div class="col-md-6 text-right">
                    <span class="footer-meta">Powered by <a href="http://polygant.ru/" rel="external">Polygant</a></span>
                    <a href="#content" class="footer-return-top">
                        <span class="fa fa-arrow-up"></span>
                    </a>
                </div>
            </div>
        </footer>
        <!-- End: Page Footer -->

    </section>
    <!-- End: Content-Wrapper -->

    <!-- Start: Right Sidebar -->
    <aside id="sidebar_right" class="nano affix">

        <!-- Start: Sidebar Right Content -->
        <div class="sidebar-right-content nano-content">

            <div class="tab-block sidebar-block br-n">
                <!-- end: .tab-content -->
            </div>

        </div>
    </aside>
    <!-- End: Right Sidebar -->

</div>
<!-- End: Main -->

<!-- BEGIN: PAGE SCRIPTS -->


<!-- END: PAGE SCRIPTS -->
<?php $this->endBody() ?>

</body>

</html>
<?php $this->endPage() ?>
