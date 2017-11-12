<?php
/**
 * @var \yii\db\ActiveRecord $model
 * @var \frontend\widgets\cropper\Widget $widget
 *
 */

use yii\helpers\Html;

?>

<div class="cropper-widget">
    <div class="col-md-3 cropper-image-block">
        <?= Html::activeHiddenInput($model, $widget->attribute, ['class' => 'photo-field']); ?>
        <?= Html::hiddenInput('width', $widget->width, ['class' => 'width-input']); ?>
        <?= Html::hiddenInput('height', $widget->height, ['class' => 'height-input']); ?>
        <?= Html::img(
            $model->{$widget->attribute.'Src'} != ''
                ? $model->{$widget->attribute.'Src'}
                : $widget->noPhotoImage,
            [
                'style' => 'max-height: ' . $widget->thumbnailHeight . 'px; max-width: ' . $widget->thumbnailWidth . 'px',
                'class' => 'thumbnail center-block',
                'data-no-photo' => $widget->noPhotoImage
            ]
        ); ?>

        <div>
            <label class="edit-upload field prepend-icon file">
                <span class="button btn-primary" data-on-text="Обновить" data-off-text="Отмена">Обновить</span>
            </label>
        </div>
    </div>

    <div class="cropper-update-area col-md-offset-3 col-md-9 col-xs-12">

        <div class="new-photo-area" style="height: <?= $widget->cropAreaHeight; ?>px; width: <?= $widget->cropAreaWidth; ?>px;">
            <div class="cropper-label">
                <span><?= $widget->label;?></span>
            </div>
        </div>
        <div class="progress hidden" style="width: <?= $widget->cropAreaWidth; ?>px;">
            <div class="progress-bar progress-bar-striped progress-bar-success active" role="progressbar" style="width: 0%">
                <span class="sr-only"></span>
            </div>
        </div>

        <div class="cropper-buttons">
            <button type="button" class="btn btn-sm btn-danger delete-photo" aria-label="<?= Yii::t('cropper', 'DELETE_PHOTO');?>">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> <?= Yii::t('cropper', 'DELETE_PHOTO');?>
            </button>
            <button type="button" class="btn btn-sm btn-success crop-photo hidden" aria-label="<?= Yii::t('cropper', 'CROP_PHOTO');?>">
                <span class="glyphicon glyphicon-scissors" aria-hidden="true"></span> <?= Yii::t('cropper', 'CROP_PHOTO');?>
            </button>
            <button type="button" class="btn btn-sm btn-info upload-new-photo hidden" aria-label="<?= Yii::t('cropper', 'UPLOAD_ANOTHER_PHOTO');?>">
                <span class="glyphicon glyphicon-picture" aria-hidden="true"></span> <?= Yii::t('cropper', 'UPLOAD_ANOTHER_PHOTO');?>
            </button>
        </div>

    </div>

</div>