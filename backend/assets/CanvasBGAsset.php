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

class CanvasBGAsset extends AssetBundle
{
    public $sourcePath = '@upload';

    public $css = [
    ];

    public $js = [
        'js/utility/canvasbg/canvasbg.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
