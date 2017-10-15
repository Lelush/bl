<?php
/**
 * Created by PhpStorm.
 * User: mirocow
 * Date: 26.06.15
 * Time: 16:16
 */

namespace frontend\assets;

use Yii;
use yii\web\AssetBundle;

class DateTimePickerAsset extends AssetBundle
{
    public $sourcePath = '@upload';

    public $css = [
    ];

    public $js = [
        'admin-tools/admin-forms/js/jquery-ui-datepicker.min.js'
    ];

    public $depends = [
        'frontend\assets\JuiAsset',
    ];
}