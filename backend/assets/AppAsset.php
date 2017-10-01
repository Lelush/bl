<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = '@upload';

    public $css = [
        'skin/default_skin/css/theme.css',
        'admin-tools/admin-forms/css/admin-forms.css',
        'css/style.css',
    ];

    public $js = [
        'js/utility/utility.js',
        'js/editable.js',
        'js/main.js',
        'js/custom.js'
    ];

    public $depends = [
        'backend\assets\JuiAsset',
        'backend\assets\LaddaAsset',
        'backend\assets\DataTablesAsset',
        'backend\assets\DateTimePickerAsset',
        'backend\assets\BootstrapConfirmationAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
