<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => "ru-RU",
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ]
    ],
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
            'class' => 'frontend\components\View',
        ],
        'formatter' => [
            'dateFormat' => 'php:Y-m-d',
            'datetimeFormat' => 'php:d.m.Y H:i'
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => '@upload',
                    'css' => ['skin/default_skin/css/theme.css'],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js'=>[]
                ],
            ],
            'class' => 'yii\web\AssetManager',
            'linkAssets' => !YII_DEBUG,
            'forceCopy' => YII_DEBUG
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'class' => 'frontend\components\User',
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
            'enableStrictParsing' => true,
            'rules' => array(
                [
                    'pattern' => '/my-page',
                    'route' => 'users/my-page',
                    'suffix' => '.html'
                ],
                [
                    'pattern' => 'images/upload/<type:[-\w]+>',
                    'route' => 'images/upload',
                    'suffix' => ''
                ],
                [
                    'pattern'=>'users/uploadPhoto',
                    'route'=>'users/uploadPhoto',
                    'suffix'=>'/'
                ],
                [
                    'pattern' => '<controller:\w+>',
                    'route' => '<controller>/index',
                    'suffix' => '.html'
                ],
                [
                    'pattern' => '<controller:\w+>/<id:\d+>',
                    'route' => '<controller>/view',
                    'suffix' => '.html'
                ],
                [
                    'pattern' => '<controller:\w+>/<action:[-\w]+>/<id:\d+>',
                    'route' => '<controller>/<action>',
                    'suffix' => '.html'
                ],
                [
                    'pattern' => '<controller:\w+>/<action:[-\w]+>',
                    'route' => '<controller>/<action>',
                    'suffix' => '.html'
                ],

            ),
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];
