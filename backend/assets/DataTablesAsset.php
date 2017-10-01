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

class DataTablesAsset extends AssetBundle
{
    public $sourcePath = '@upload';

    public $css = [
        'js/utility/datatables/media/css/dataTables.bootstrap.css',
        'js/utility/datatables/media/css/dataTables.plugins.css',
    ];

    public $js = [
        'js/utility/datatables/media/js/jquery.dataTables.js',
        'js/utility/datatables/media/js/dataTables.bootstrap.js',
    ];

    public $depends = [
        'backend\assets\JuiAsset',
    ];
}
