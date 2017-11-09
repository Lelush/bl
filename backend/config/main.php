<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'name' => 'Best Location',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'ru-Ru',
                ],
            ],
        ],
        'view' => [
            'class' => 'backend\components\View',
        ],
        'formatter' => [
            'dateFormat' => 'php:Y-m-d',
            'datetimeFormat' => 'php:d.m.Y H:i'
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            'rules' => array(
                'users/create/<type:[-\w]+>'                => 'users/create',
                'images/upload/<type:[-\w]+>'               => 'images/upload',
                '<controller:\w+>'                          => '<controller>/index',
                '<controller:\w+>/<id:\d+>'                 => '<controller>/view',
                '<controller:\w+>/<action:[-\w]+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:[-\w]+>'          => '<controller>/<action>',

            ),
        ],
        'user' => [
            'class' => 'common\components\User',
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => '@upload',
                    'css' => ['skin/admin_skin/css/theme.css'],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js'=>[]
                ],
            ],
            'class' => 'yii\web\AssetManager',
            'linkAssets' => !YII_DEBUG,
            'forceCopy' => YII_DEBUG
        ],


    ],
    'params' => $params,

];
