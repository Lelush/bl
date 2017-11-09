<?php
/**
 * Created by PhpStorm.
 * User: Sefirot
 * Date: 06.11.2017
 * Time: 20:36
 */

use kartik\form\ActiveForm;

?>

<div class="col-md-12 col-lg-12 col-xs-12">
    <div class="row">
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <div class="col-md-12 col-xs-12 col-lg-12 choose-headline">
              <span>
                Выбери кто ты
              </span>
        </div>

        <div id="cb-main" class="col-md-12 col-xs-12 col-lg-12 choose-blocks">

            <div class="col-md-2 col-lg-2 col-xs-12 choose-block mt15">
                <div class="row">
                    <div class="image-wrapper min">
                        <div class="image-wrapper__heading green">
                            <img src="<?= Yii::getAlias('@static') ?>/img/users/discounter-icon.svg"/>
                            Discounter
                        </div>
                        <img class="main" src="<?= Yii::getAlias('@static') ?>/img/users/discounter.png"/>
                    </div>
                    <div class="text-wrapper">
                        <div class="choose-block__bars clearfix">

                            <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                     src="<?= Yii::getAlias('@static') ?>/img/users/activnost.svg"/>
                                <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                                    Активность
                                </span>
                                <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                    <div class="progress-bar blue" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                     src="<?= Yii::getAlias('@static') ?>/img/users/dohod.svg"/>
                                <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Доход
                      </span>
                                <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                    <div class="progress-bar green" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                     src="<?= Yii::getAlias('@static') ?>/img/users/economy.svg"/>
                                <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Экономия
                      </span>
                                <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                    <div class="progress-bar yellow" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                     src="<?= Yii::getAlias('@static') ?>/img/users/popular.svg"/>
                                <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Популярность
                      </span>
                                <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                    <div class="progress-bar red" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                     src="<?= Yii::getAlias('@static') ?>/img/users/audience.svg"/>
                                <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Аудитория
                      </span>
                                <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                    <div class="progress-bar purp" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60%</span>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <button data-modal="modal_1" class="choose-button green">
                            Выбрать
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-lg-2 col-xs-12 choose-block">
                <div class="row">
                    <div class="image-wrapper min">
                        <div class="image-wrapper__heading peach">
                            <img src="<?= Yii::getAlias('@static') ?>/img/users/popular-icon.svg"/>
                            Popular
                        </div>
                        <img class="main" src="<?= Yii::getAlias('@static') ?>/img/users/popular.png"/>
                    </div>
                    <div class="text-wrapper">
                        <div class="choose-block__bars clearfix">

                            <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                     src="<?= Yii::getAlias('@static') ?>/img/users/activnost.svg"/>
                                <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Активность
                      </span>
                                <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                    <div class="progress-bar blue" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                     src="<?= Yii::getAlias('@static') ?>/img/users/dohod.svg"/>
                                <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Доход
                      </span>
                                <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                    <div class="progress-bar green" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                     src="<?= Yii::getAlias('@static') ?>/img/users/economy.svg"/>
                                <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Экономия
                      </span>
                                <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                    <div class="progress-bar yellow" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                     src="<?= Yii::getAlias('@static') ?>/img/users/popular.svg"/>
                                <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Популярность
                      </span>
                                <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                    <div class="progress-bar red" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                     src="<?= Yii::getAlias('@static') ?>/img/users/audience.svg"/>
                                <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Аудитория
                      </span>
                                <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                    <div class="progress-bar purp" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60%</span>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <button data-modal="modal_2" class="choose-button peach">
                            Выбрать
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-lg-2 col-xs-12 choose-block mt15">
                <div class="row">
                    <div class="image-wrapper min">
                        <div class="image-wrapper__heading dark">
                            <img src="<?= Yii::getAlias('@static') ?>/img/users/luxury-icon.svg"/>
                            Luxury
                        </div>
                        <img class="main" src="<?= Yii::getAlias('@static') ?>/img/users/luxury.png"/>
                    </div>
                    <div class="text-wrapper">
                        <div class="choose-block__bars clearfix">

                            <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                     src="<?= Yii::getAlias('@static') ?>/img/users/activnost.svg"/>
                                <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Активность
                      </span>
                                <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                    <div class="progress-bar blue" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                     src="<?= Yii::getAlias('@static') ?>/img/users/dohod.svg"/>
                                <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Доход
                      </span>
                                <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                    <div class="progress-bar green" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                     src="<?= Yii::getAlias('@static') ?>/img/users/economy.svg"/>
                                <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Экономия
                      </span>
                                <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                    <div class="progress-bar yellow" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                     src="<?= Yii::getAlias('@static') ?>/img/users/popular.svg"/>
                                <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Популярность
                      </span>
                                <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                    <div class="progress-bar red" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                     src="<?= Yii::getAlias('@static') ?>/img/users/audience.svg"/>
                                <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Аудитория
                      </span>
                                <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                    <div class="progress-bar purp" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60%</span>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <button data-modal="modal_3" class="choose-button dark">
                            Выбрать
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-lg-2 col-xs-12 choose-block">
                <div class="row">
                    <div class="image-wrapper min">
                        <div class="image-wrapper__heading blue">
                            <img src="<?= Yii::getAlias('@static') ?>/img/users/rich-icon.svg"/>
                            Rich
                        </div>
                        <img class="main" src="<?= Yii::getAlias('@static') ?>/img/users/rich.png"/>
                    </div>
                    <div class="text-wrapper">
                        <div class="choose-block__bars clearfix">

                            <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                     src="<?= Yii::getAlias('@static') ?>/img/users/activnost.svg"/>
                                <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Активность
                      </span>
                                <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                    <div class="progress-bar blue" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                     src="<?= Yii::getAlias('@static') ?>/img/users/dohod.svg"/>
                                <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Доход
                      </span>
                                <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                    <div class="progress-bar green" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                     src="<?= Yii::getAlias('@static') ?>/img/users/economy.svg"/>
                                <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Экономия
                      </span>
                                <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                    <div class="progress-bar yellow" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                     src="<?= Yii::getAlias('@static') ?>/img/users/popular.svg"/>
                                <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Популярность
                      </span>
                                <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                    <div class="progress-bar red" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                     src="<?= Yii::getAlias('@static') ?>/img/users/audience.svg"/>
                                <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Аудитория
                      </span>
                                <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                    <div class="progress-bar purp" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60%</span>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <button data-modal="modal_4" class="choose-button blue">
                            Выбрать
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-lg-2 col-xs-12 choose-block mt15">
                <div class="row">
                    <div class="image-wrapper min">
                        <div class="image-wrapper__heading yellow">
                            <img src="<?= Yii::getAlias('@static') ?>/img/users/tourist-icon.svg"/>
                            Tourist
                        </div>
                        <img class="main" src="<?= Yii::getAlias('@static') ?>/img/users/tourist.png"/>
                    </div>
                    <div class="text-wrapper">
                        <div class="choose-block__bars clearfix">

                            <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                     src="<?= Yii::getAlias('@static') ?>/img/users/activnost.svg"/>
                                <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Активность
                      </span>
                                <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                    <div class="progress-bar blue" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                     src="<?= Yii::getAlias('@static') ?>/img/users/dohod.svg"/>
                                <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Доход
                      </span>
                                <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                    <div class="progress-bar green" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                     src="<?= Yii::getAlias('@static') ?>/img/users/economy.svg"/>
                                <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Экономия
                      </span>
                                <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                    <div class="progress-bar yellow" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                     src="<?= Yii::getAlias('@static') ?>/img/users/popular.svg"/>
                                <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Популярность
                      </span>
                                <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                    <div class="progress-bar red" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                     src="<?= Yii::getAlias('@static') ?>/img/users/audience.svg"/>
                                <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Аудитория
                      </span>
                                <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                    <div class="progress-bar purp" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60%</span>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <button data-modal="modal_5" class="choose-button yellow">
                            Выбрать
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-xs-12 col-lg-12 choose-blocks choose-block_more">
            <div id="modal_1" class="col-md-12 col-xs-12 col-lg-12 choose-modal choose-block_more-box">

                <div class="col-md-3 col-lg-3 col-xs-12 choose-block">
                    <div class="row">
                        <div class="image-wrapper min">
                            <div class="image-wrapper__heading green">
                                <img src="<?= Yii::getAlias('@static') ?>/img/users/discounter-icon.svg"/>
                                Discounter
                            </div>
                            <img class="main" src="<?= Yii::getAlias('@static') ?>/img/users/discounter.png"/>
                        </div>
                        <div class="text-wrapper">
                            <div class="choose-block__bars clearfix">

                                <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                    <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                         src="<?= Yii::getAlias('@static') ?>/img/users/activnost.svg"/>
                                    <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Активность
                      </span>
                                    <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                        <div class="progress-bar blue" role="progressbar" aria-valuenow="60"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                    <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                         src="<?= Yii::getAlias('@static') ?>/img/users/dohod.svg"/>
                                    <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Доход
                      </span>
                                    <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                        <div class="progress-bar green" role="progressbar" aria-valuenow="60"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                    <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                         src="<?= Yii::getAlias('@static') ?>/img/users/economy.svg"/>
                                    <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Экономия
                      </span>
                                    <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                        <div class="progress-bar yellow" role="progressbar" aria-valuenow="60"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                    <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                         src="<?= Yii::getAlias('@static') ?>/img/users/popular.svg"/>
                                    <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Популярность
                      </span>
                                    <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                        <div class="progress-bar red" role="progressbar" aria-valuenow="60"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                    <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                         src="<?= Yii::getAlias('@static') ?>/img/users/audience.svg"/>
                                    <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Аудитория
                      </span>
                                    <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                        <div class="progress-bar purp" role="progressbar" aria-valuenow="60"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60%</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-lg-8 col-xs-12 more-box__block green">
                    <h2>
                        Discounter
                    </h2>
                    <h2 class="fs16">Студент или сидит у предков на шее как украшение</h2>
                    <p>
                        Bl - Социальная сеть нового поколения подстраивающаяся под образ жизни, запросы и потребности
                        каждого человека, а ее новые возможности создают индивидуальность каждого ее пользователя,
                        позволяя эффективнее и быстрее развиваться, знакомится и находить нужных людей, общаться и
                        выстраивать с ними нужные вам отношение, что в последствии будет сказываться на уровне вашей
                        популярности,получаемой выгоды и дохода, создавая яркую и насыщенную жизнь вокруг вас.
                    </p>
                    <p>
                        Любишь получать самые выгодные предложения и проводить время весело вместе с друзьями, семьей,
                        коллегами. В лучших местах ты сможешь найти все самые лучшие места и компании города, в которых
                        ты сможешь экономить на посещении до 100%.
                    </p>
                    <button class="more-box_button select" type="submit" name="Discounter">
                        Выбрать
                    </button>
                    <button class="more-box_button back">
                        Назад
                    </button>
                </div>
            </div>

            <div id="modal_2" class="col-md-12 col-xs-12 col-lg-12 choose-modal choose-block_more-box">

                <div class="col-md-3 col-lg-3 col-xs-12 choose-block">
                    <div class="row">
                        <div class="image-wrapper min">
                            <div class="image-wrapper__heading peach">
                                <img src="<?= Yii::getAlias('@static') ?>/img/users/popular-icon.svg"/>
                                Popular
                            </div>
                            <img class="main" src="<?= Yii::getAlias('@static') ?>/img/users/popular.png"/>
                        </div>
                        <div class="text-wrapper">
                            <div class="choose-block__bars clearfix">

                                <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                    <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                         src="<?= Yii::getAlias('@static') ?>/img/users/activnost.svg"/>
                                    <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Активность
                      </span>
                                    <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                        <div class="progress-bar blue" role="progressbar" aria-valuenow="60"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                    <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                         src="<?= Yii::getAlias('@static') ?>/img/users/dohod.svg"/>
                                    <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Доход
                      </span>
                                    <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                        <div class="progress-bar green" role="progressbar" aria-valuenow="60"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                    <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                         src="<?= Yii::getAlias('@static') ?>/img/users/economy.svg"/>
                                    <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Экономия
                      </span>
                                    <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                        <div class="progress-bar yellow" role="progressbar" aria-valuenow="60"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                    <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                         src="<?= Yii::getAlias('@static') ?>/img/users/popular.svg"/>
                                    <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Популярность
                      </span>
                                    <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                        <div class="progress-bar red" role="progressbar" aria-valuenow="60"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                    <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                         src="<?= Yii::getAlias('@static') ?>/img/users/audience.svg"/>
                                    <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Аудитория
                      </span>
                                    <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                        <div class="progress-bar purp" role="progressbar" aria-valuenow="60"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60%</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-lg-8 col-xs-12 more-box__block peach">
                    <h2>
                        Popular
                    </h2>
                    <h2 class="fs16">Блоггер, актер, ведущий, медиа личность</h2>
                    <p>
                        Bl - Социальная сеть нового поколения подстраивающаяся под образ жизни, запросы и потребности
                        каждого человека, а ее новые возможности создают индивидуальность каждого ее пользователя,
                        позволяя эффективнее и быстрее развиваться, знакомится и находить нужных людей, общаться и
                        выстраивать с ними нужные вам отношение, что в последствии будет сказываться на уровне вашей
                        популярности,получаемой выгоды и дохода, создавая яркую и насыщенную жизнь вокруг вас.
                    </p>
                    <p>
                        Любишь быть в центре внимания? Любишь делать обзоры? Ты интересный, харизматичный и амбициозный
                        человек обладающий большим кругом друзей, тогда используй свои возможности по максиму.
                    </p>
                    <p>
                        Посещай места, создавай контент и рассказывай о них. Стань экспертом и создавай обзоры на разные
                        тематики и получи новую возможность зарабатывать и экономить. Получи доступ к лучшим компаниям и
                        стань их лицом, партнером.
                    </p>

                    <button class="more-box_button select" type="submit" name="Popular">
                        Выбрать
                    </button>
                    <button class="more-box_button back">
                        Назад
                    </button>
                </div>
            </div>

            <div id="modal_3" class="col-md-12 col-xs-12 col-lg-12 choose-modal choose-block_more-box">

                <div class="col-md-3 col-lg-3 col-xs-12 choose-block">
                    <div class="row">
                        <div class="image-wrapper min">
                            <div class="image-wrapper__heading dark">
                                <img src="<?= Yii::getAlias('@static') ?>/img/users/luxury-icon.svg"/>
                                Luxury
                            </div>
                            <img class="main" src="<?= Yii::getAlias('@static') ?>/img/users/luxury.png"/>
                        </div>
                        <div class="text-wrapper">
                            <div class="choose-block__bars clearfix">

                                <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                    <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                         src="<?= Yii::getAlias('@static') ?>/img/users/activnost.svg"/>
                                    <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Активность
                      </span>
                                    <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                        <div class="progress-bar blue" role="progressbar" aria-valuenow="60"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                    <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                         src="<?= Yii::getAlias('@static') ?>/img/users/dohod.svg"/>
                                    <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Доход
                      </span>
                                    <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                        <div class="progress-bar green" role="progressbar" aria-valuenow="60"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                    <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                         src="<?= Yii::getAlias('@static') ?>/img/users/economy.svg"/>
                                    <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Экономия
                      </span>
                                    <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                        <div class="progress-bar yellow" role="progressbar" aria-valuenow="60"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                    <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                         src="<?= Yii::getAlias('@static') ?>/img/users/popular.svg"/>
                                    <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Популярность
                      </span>
                                    <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                        <div class="progress-bar red" role="progressbar" aria-valuenow="60"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                    <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                         src="<?= Yii::getAlias('@static') ?>/img/users/audience.svg"/>
                                    <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Аудитория
                      </span>
                                    <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                        <div class="progress-bar purp" role="progressbar" aria-valuenow="60"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60%</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-lg-8 col-xs-12 more-box__block dark">
                    <h2>
                        Luxury
                    </h2>
                    <h2 class="fs16">Узнавай первым и получай лучшее</h2>
                    <p>
                        Bl - Социальная сеть нового поколения подстраивающаяся под образ жизни, запросы и потребности
                        каждого человека, а ее новые возможности создают индивидуальность каждого ее пользователя,
                        позволяя эффективнее и быстрее развиваться, знакомится и находить нужных людей, общаться и
                        выстраивать с ними нужные вам отношение, что в последствии будет сказываться на уровне вашей
                        популярности,получаемой выгоды и дохода, создавая яркую и насыщенную жизнь вокруг вас.
                    </p>
                    <p>
                        Будь в курсе только лучших мероприятий и первым узнавай о новых и уникальных предложениях от
                        компаний на покупку на товаров и услуг.
                    </p>
                    <p>
                        Будь в центре внимания на всех крутых тусовках, узнавай первым о новых поступлениях уникальных
                        товаров и услуг.
                    </p>
                    <p>
                        Получи возможность добавлять свои компании в избранные, чтобы следить за их новостями. Тебя
                        никогда не будут уведомлять о скидках.
                    </p>
                    <button class="more-box_button select" type="submit" name="Luxury">
                        Выбрать
                    </button>
                    <button class="more-box_button back">
                        Назад
                    </button>
                </div>
            </div>

            <div id="modal_4" class="col-md-12 col-xs-12 col-lg-12 choose-modal choose-block_more-box">

                <div class="col-md-3 col-lg-3 col-xs-12 choose-block">
                    <div class="row">
                        <div class="image-wrapper min">
                            <div class="image-wrapper__heading blue">
                                <img src="<?= Yii::getAlias('@static') ?>/img/users/rich-icon.svg"/>
                                Rich
                            </div>
                            <img class="main" src="<?= Yii::getAlias('@static') ?>/img/users/rich.png"/>
                        </div>
                        <div class="text-wrapper">
                            <div class="choose-block__bars clearfix">

                                <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                    <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                         src="<?= Yii::getAlias('@static') ?>/img/users/activnost.svg"/>
                                    <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Активность
                      </span>
                                    <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                        <div class="progress-bar blue" role="progressbar" aria-valuenow="60"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                    <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                         src="<?= Yii::getAlias('@static') ?>/img/users/dohod.svg"/>
                                    <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Доход
                      </span>
                                    <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                        <div class="progress-bar green" role="progressbar" aria-valuenow="60"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                    <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                         src="<?= Yii::getAlias('@static') ?>/img/users/economy.svg"/>
                                    <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Экономия
                      </span>
                                    <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                        <div class="progress-bar yellow" role="progressbar" aria-valuenow="60"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                    <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                         src="<?= Yii::getAlias('@static') ?>/img/users/popular.svg"/>
                                    <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Популярность
                      </span>
                                    <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                        <div class="progress-bar red" role="progressbar" aria-valuenow="60"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                    <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                         src="<?= Yii::getAlias('@static') ?>/img/users/audience.svg"/>
                                    <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Аудитория
                      </span>
                                    <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                        <div class="progress-bar purp" role="progressbar" aria-valuenow="60"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60%</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-lg-8 col-xs-12 more-box__block blue">
                    <h2>
                        Rich
                    </h2>
                    <h2 class="fs16">Бизнесмен, коуч, эксперт, продюсер</h2>
                    <p>
                        Bl - Социальная сеть нового поколения подстраивающаяся под образ жизни, запросы и потребности
                        каждого человека, а ее новые возможности создают индивидуальность каждого ее пользователя,
                        позволяя эффективнее и быстрее развиваться, знакомится и находить нужных людей, общаться и
                        выстраивать с ними нужные вам отношение, что в последствии будет сказываться на уровне вашей
                        популярности,получаемой выгоды и дохода, создавая яркую и насыщенную жизнь вокруг вас.
                    </p>
                    <p>
                        Хочешь зарабатывать создавай уникальные задания для жителей города и компаний, за которые
                        клиенты будут получать вознаграждения, а компании клиентов. Заниматься продвижением компаний и
                        на прямую взаимодействуй с аудиторией </p>
                    <p>
                        <br/>
                    </p>
                    <button class="more-box_button select" type="submit" name="Rich">
                        Выбрать
                    </button>
                    <button class="more-box_button back">
                        Назад
                    </button>
                </div>
            </div>

            <div id="modal_5" class="col-md-12 col-xs-12 col-lg-12 choose-modal choose-block_more-box">

                <div class="col-md-3 col-lg-3 col-xs-12 choose-block">
                    <div class="row">
                        <div class="image-wrapper min">
                            <div class="image-wrapper__heading yellow">
                                <img src="<?= Yii::getAlias('@static') ?>/img/users/tourist-icon.svg"/>
                                Tourist
                            </div>
                            <img class="main" src="<?= Yii::getAlias('@static') ?>/img/users/tourist.png"/>
                        </div>
                        <div class="text-wrapper">
                            <div class="choose-block__bars clearfix">

                                <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                    <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                         src="<?= Yii::getAlias('@static') ?>/img/users/activnost.svg"/>
                                    <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Активность
                      </span>
                                    <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                        <div class="progress-bar blue" role="progressbar" aria-valuenow="60"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                    <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                         src="<?= Yii::getAlias('@static') ?>/img/users/dohod.svg"/>
                                    <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Доход
                      </span>
                                    <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                        <div class="progress-bar green" role="progressbar" aria-valuenow="60"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                    <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                         src="<?= Yii::getAlias('@static') ?>/img/users/economy.svg"/>
                                    <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Экономия
                      </span>
                                    <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                        <div class="progress-bar yellow" role="progressbar" aria-valuenow="60"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                    <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                         src="<?= Yii::getAlias('@static') ?>/img/users/popular.svg"/>
                                    <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Популярность
                      </span>
                                    <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                        <div class="progress-bar red" role="progressbar" aria-valuenow="60"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="choose-block__barWrapper col-md-12 col-lg-12 col-xs-12">
                                    <img class="choose-block__icon col-md-2 col-lg-2 col-xs-2"
                                         src="<?= Yii::getAlias('@static') ?>/img/users/audience.svg"/>
                                    <span class="choose-block__heading col-md-10 col-lg-10 col-xs-10">
                        Аудитория
                      </span>
                                    <div class="progress progress-bar-xxs col-md-10 col-lg-10 col-xs-10 pull-right choose-block__bar">
                                        <div class="progress-bar purp" role="progressbar" aria-valuenow="60"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60%</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-lg-8 col-xs-12 more-box__block yellow">
                    <h2>
                        Tourist
                    </h2>

                    <h2 class="fs16">Твой гид по лучшим городам мира</h2>
                    <p>
                        Bl - Социальная сеть нового поколения подстраивающаяся под образ жизни, запросы и потребности
                        каждого человека, а ее новые возможности создают индивидуальность каждого ее пользователя,
                        позволяя эффективнее и быстрее развиваться, знакомится и находить нужных людей, общаться и
                        выстраивать с ними нужные вам отношение, что в последствии будет сказываться на уровне вашей
                        популярности,получаемой выгоды и дохода, создавая яркую и насыщенную жизнь вокруг вас.
                    </p>
                    <p>
                        Узнай о самых лучших местах отдыха с помощью интересного контента, используй интерактивную
                        карту, чтоб быть в курсе всех интересных событий города.
                    </p>
                    <p>
                        Посещай места и проводи время с пользуй получая приятные впечатления от активных бонусных и
                        дисконтных программ. Проявляй активность создавая фото и видео посещая лучшие места и компании
                        города.
                    </p>
                    <button class="more-box_button select" type="submit" name="Tourist">
                        Выбрать
                    </button>
                    <button class="more-box_button back">
                        Назад
                    </button>
                </div>
            </div>
        </div>

        <? ActiveForm::end()?>
    </div>
</div>
