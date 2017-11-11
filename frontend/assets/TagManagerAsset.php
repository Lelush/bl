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

class TagManagerAsset extends AssetBundle
{
    public $sourcePath = '@upload';

    public $css = [
        'js/utility/tagmanager/tagmanager.css'
    ];

    public $js = [
        'js/utility/tagmanager/tagmanager.js'
    ];

    public $depends = [
        'frontend\assets\JuiAsset',
    ];
}