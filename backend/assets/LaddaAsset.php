<?php
/**
 * Created by PhpStorm.
 * User: mirocow
 * Date: 26.06.15
 * Time: 16:16
 */

namespace backend\assets;

use Yii;
use yii\web\AssetBundle;

class LaddaAsset extends AssetBundle
{
    public $sourcePath = '@upload';

    public $css = [
        'js/utility/ladda/ladda.min.css'
    ];

    public $js = [
        'js/utility/ladda/ladda.min.js'
    ];

    public $depends = [
        'backend\assets\JuiAsset',
    ];
}