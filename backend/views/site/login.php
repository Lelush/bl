<?php
use backend\widgets\AdminForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form AdminForm */
/* @var $model \common\models\LoginForm */
/* @var $login string|null */

$this->title = 'Вход';
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

                    <?php $form = AdminForm::begin(['id' => 'login-form']); ?>
                    <div class="panel-body bg-light p25 pb15">
                        <?= $form->field($model, 'email')->textInput(['value'=>$login])->icon(['name'=>'fa fa-envelope']);?>
                        <?= $form->field($model, 'password')->passwordInput(['value'=>$login?'123456':null])->icon(['name'=>'fa fa-lock']);?>
                    </div>

                    <div class="panel-footer clearfix">
                        <?= Html::submitButton('Вход', ['class' => 'button btn-primary mr10 pull-right', 'name' => 'login-button']) ?>
                        <?= $form->field($model, 'rememberMe')->switchBoxRight(['switchOptions'=>['class'=>'switch-primary mt10']])?>
                    </div>

                    <?php AdminForm::end(); ?>
                </div>
            </div>

        </section>
        <!-- End: Content -->

    </section>
    <!-- End: Content-Wrapper -->

</div>
<!-- End: Main -->
