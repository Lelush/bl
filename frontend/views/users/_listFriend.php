<?php
/**
 * Created by PhpStorm.
 * User: Sefirot
 *
 * @var $model \common\models\User
 */
use common\enums\UserCategory;
?>


<div class="col-md-12 col-lg-12 col-xs-12 friends-list_item" data-id="<?$model->id?>">
    <div class="col-md-5 col-xs-12 friend-info_main">
        <img class="avatar" src="<?= $model->userInfo->avatarSrc;?>"/>
        <div class="info-main_text">
            <!--                    <span class="status">-->
            <!--                      Онлайн-->
            <!--                    </span>-->
            <span class="name">
                <?= $model->fullName; ?>
            </span>
        </div>
    </div>
    <div class="col-md-4 col-lg-3 col-xs-12 friend-info_info">
            <span class="headline">
                Статус
            </span>
            <span><?= $model->userInfo?$model->userInfo->state:'не установлен'?></span>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <span class="headline">
                    Класс
                </span>
                <span>
                    <? if($model->userInfo): ?>
                        <?= UserCategory::getValue($model->userInfo->scope)?>
                    <? else:?>
                        не выбран
                    <? endif;?>
                </span>
            </div>

        </div>
    </div>
    <div class="col-md-3 col-lg-4 col-xs-12 friend-info_action">
<!--        <button class="info-action_button">-->
<!--            Пригласить-->
<!--        </button>-->
        <!--                    <button class="info-action_button">-->
        <!--                        Написать-->
        <!--                    </button>-->
    </div>
</div>


