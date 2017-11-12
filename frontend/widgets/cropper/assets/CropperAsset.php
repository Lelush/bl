<?php

namespace frontend\widgets\cropper\assets;

use yii\web\AssetBundle;

/**
 * Widget asset bundle
 */
class CropperAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@frontend/widgets/cropper/web/';

    /**
     * @inheritdoc
     */
    public $css = [
        'css/cropper.css'
    ];

    /**
     * @inheritdoc
     */
    public $js = [
        'js/cropper.js'
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
        'frontend\widgets\cropper\assets\JcropAsset',
        'frontend\widgets\cropper\assets\SimpleAjaxUploaderAsset',
    ];
}
