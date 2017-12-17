<?php
/**
 * Created by PhpStorm.
 * User: Sefirot
 *
 * @var $isOwner boolean
 * @var $model \common\models\User
 * @var $dataProvider \yii\data\ActiveDataProvider
 * @var $searchModel \frontend\models\FriendsForm
 * @var $onlineCount integer
 */
use yii\widgets\ListView;
use yii\widgets\Pjax;
use frontend\widgets\PjaxAlert;
use common\enums\UserCategory;

$this->title = $isOwner ? 'Мои друзья' : 'Друзья '.$model->fullName

?>

<? Pjax::begin([
    'clientOptions'=> ['method'=>'post'],
    'id' => 'pjax-friends'
]);?>

<?= PjaxAlert::widget() ?>

<?php $form =  \frontend\widgets\AdminForm::begin([
    'enableClientValidation' => false,
    'options' => [
        'data-pjax-target' => '#pjax-friends'
    ]
]) ?>
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
            <?= \yii\bootstrap\Html::activeTextInput($searchModel, 'name', ['placeholder'=>'Искать', 'class'=>'change-pjax-delay'])?>
            <button type="submit" class="friends-search_button"></button>
        </div>
        <div class="updates-tabs col-md-12 col-xs-12">
            <span id="all-tab" class="active">
                Все <span>(<?= $dataProvider->getTotalCount(); ?>)</span>
            </span>
            <? if($onlineCount): ?>
            <span id="online-tab">
                В сети <span>(<?= $onlineCount; ?>)</span>
            </span>
            <? endif; ?>
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
            <? if(false):  /** @TODO ??? */?>
            <div class="col-md-12 col-lg-12 col-xs-12 friends-filter_block">
                <div class="col-md-10 col-lg-10 center-block">
                    <? if(false): /** @TODO ??? */?>
                    <label class="option option-primary">
                        <input type="checkbox" name="mobileos" value="">
                        <span class="checkbox"></span>
                        <span class="text">
                      Все
                    </span>
                    </label>
                    <? endif; ?>
                    <?= $form->field($searchModel, 'friends')->checkbox(['class'=>'change-pjax-delay'])->label('Друзья');?>
                    <?= $form->field($searchModel, 'people')->checkbox(['class'=>'change-pjax-delay'])->label('Люди');?>
                </div>

            </div>
            <? endif; ?>

            <div class="col-md-12 col-lg-12 col-xs-12 friends-filter_block">
                <div class="col-md-10 col-lg-10 center-block">
                    <? foreach (UserCategory::getList() as $userCategory):?>
                    <?= $form->field($searchModel, strtolower($userCategory))->checkbox(['class'=>'change-pjax-delay'])->label($userCategory);?>
                    <? endforeach; ?>
                </div>

            </div>

            <? if(false):?>
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
            <? endif; ?>
        </div>
    </div>


</div>
<? \frontend\widgets\AdminForm::end(); ?>
<? Pjax::end(); ?>
