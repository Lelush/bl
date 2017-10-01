<?php
use frontend\widgets\AdminForm;
use yii\helpers\Html;
use common\enums\Role;

/* @var $this yii\web\View */
/* @var $form AdminForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Учетная запись отключена';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs(<<<JS

    "use strict";

    CanvasBG.init({
        Loc: {
            x: window.innerWidth / 2,
            y: window.innerHeight / 3.3
        }
    });

JS
);
?>
<!-- Start: Main -->
<div id="main" class="animated fadeIn">

    <!-- Start: Content-Wrapper -->
    <section id="content_wrapper">

        <!-- begin canvas animation bg -->
        <div id="canvas-wrapper">
            <canvas id="demo-canvas"></canvas>
        </div>

        <!-- Begin: Content -->
        <section id="content">

            <div class="admin-form theme-info mw500" id="login1">
                <div class="panel mt30 mb25">

                    <div class="panel-body bg-light p25 pb15">
                        <? if( Yii::$app->user->can(Role::ADMIN) || Yii::$app->user->can(Role::MANAGER)): ?>
                            <p class="text-center fs18">Данная учетная запись была отключена от системы. <br /> Для восстановления доступа обратитесь к администратору или напишите на email info@masterlead.ru</p>
                        <? else: ?>
                            <p class="text-center fs18">Ваша учетная запись была отключена от системы CRM. Пожалуйста, обратитесь к вашему менеджеру для разрешения ситуации.<br/> Просим прощения за доставленные неудобства.</p>
                        <? endif; ?>

                    </div>

                    <div class="panel-footer clearfix">
                        <?= Html::a('Выход', ['/site/logout'],['class' => 'button btn-primary mr10 pull-right', 'name' => 'logout-button']) ?>
                    </div>

                </div>
            </div>

        </section>
        <!-- End: Content -->

    </section>
    <!-- End: Content-Wrapper -->

</div>
<!-- End: Main -->
