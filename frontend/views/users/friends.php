<?php
/**
 * Created by PhpStorm.
 * User: Sefirot
 *
 * @var $isOwner boolean
 * @var $model \common\models\User
 * @var $dataProvider \yii\data\ActiveDataProvider
 */
use yii\widgets\ListView;
?>

<div class="friends-page">

    <div class="col-md-12 col-xs-12">
        <h1 class="reg-heading">
            <? if($isOwner): ?>
                Мои друзья
            <? else: ?>
                Друзья <?= $model->fullName?>
            <? endif; ?>
        </h1>
        <div class="friends-search col-md-2 col-lg-2 col-xs-12">
            <input type="search" placeholder="Искать">
            <button type="submit" class="friends-search_button"></button>
        </div>
        <div class="updates-tabs col-md-12 col-xs-12">
                  <span id="all-tab" class="active">
                    Все <span>(240)</span>
                  </span>
<!--            <span id="online-tab">-->
<!--                    В сети <span>(124)</span>-->
<!--                  </span>-->
        </div>
    </div>

    <div class="col-md-12 col-xs-12 mt20">
        <div class="col-md-8 col-lg-8 col-xs-12 friends-list">
            <?php echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_listFriend',
            ]);?>

        </div>

        <div class="col-md-3 col-lg-3 hidden-xs friends-filter">
            <div class="col-md-12 col-lg-12 col-xs-12 friends-filter_block">
                <div class="col-md-10 col-lg-10 center-block">
                    <label class="option option-primary">
                        <input type="checkbox" name="mobileos" value="">
                        <span class="checkbox"></span>
                        <span class="text">
                      Все
                    </span>
                    </label>
                    <label class="option option-primary">
                        <input type="checkbox" name="mobileos" value="">
                        <span class="checkbox"></span>
                        <span class="text">
                      Друзья
                    </span>
                    </label>
                    <label class="option option-primary">
                        <input type="checkbox" name="mobileos" value="">
                        <span class="checkbox"></span>
                        <span class="text">
                      Люди
                    </span>
                    </label>
                </div>

            </div>

            <div class="col-md-12 col-lg-12 col-xs-12 friends-filter_block">
                <div class="col-md-10 col-lg-10 center-block">
                    <label class="option option-primary">
                        <input type="checkbox" name="mobileos" value="">
                        <span class="checkbox"></span>
                        <span class="text">
                      Discounter
                    </span>
                    </label>
                    <label class="option option-primary">
                        <input type="checkbox" name="mobileos" value="">
                        <span class="checkbox"></span>
                        <span class="text">
                      Popular
                    </span>
                    </label>
                    <label class="option option-primary">
                        <input type="checkbox" name="mobileos" value="">
                        <span class="checkbox"></span>
                        <span class="text">
                      Luxury
                    </span>
                    </label>
                    <label class="option option-primary">
                        <input type="checkbox" name="mobileos" value="">
                        <span class="checkbox"></span>
                        <span class="text">
                      Rich
                    </span>
                    </label>
                    <label class="option option-primary">
                        <input type="checkbox" name="mobileos" value="">
                        <span class="checkbox"></span>
                        <span class="text">
                      Tourist
                    </span>
                    </label>
                </div>

            </div>

            <div class="col-md-12 col-lg-12 col-xs-12 friends-filter_block">
                <div class="col-md-10 col-lg-10 center-block">
                    <label class="option option-primary">
                        <input type="checkbox" name="mobileos" value="">
                        <span class="checkbox"></span>
                        <span class="text">
                      Открыт к общению
                    </span>
                    </label>
                    <label class="option option-primary">
                        <input type="checkbox" name="mobileos" value="">
                        <span class="checkbox"></span>
                        <span class="text">
                      Текст
                    </span>
                    </label>
                    <label class="option option-primary">
                        <input type="checkbox" name="mobileos" value="">
                        <span class="checkbox"></span>
                        <span class="text">
                      Текст
                    </span>
                    </label>
                    <label class="option option-primary">
                        <input type="checkbox" name="mobileos" value="">
                        <span class="checkbox"></span>
                        <span class="text">
                      Текст
                    </span>
                    </label>
                </div>

            </div>
        </div>
    </div>


</div>
