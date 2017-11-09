<?php
$params = array_merge(
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$prefixFunc = function($message) {
    if (empty($_SERVER['argv'])) {
        $request = Yii::$app->request->getUrl();
    } else {
        $request = implode(' ', $_SERVER['argv']);
    }
    return "[$request]";
};
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'aliases' => [
        '@static' => 'http://static.blrevolution.com',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'dirMode' => 0777,
            'fileMode' => 0666,
        ],
        'consoleRunner' => [
            'class' => 'toriphes\console\Runner',
            'yiiscript' => 'yii'
        ],
        'log' => [
            'targets' => [
                'email' => [
                    'class' => 'common\components\EmailTarget',
                    'levels' => ['warning', 'error'],
                    'message' => [
                        'from' => [$params['errorsEmail'] => 'BL errors'],
                        'to' =>  $params['devEmails'],
                    ],
                    'prefix' => $prefixFunc,
                    'enabled' => $params['sendDevEmails'],
                    'except' => [
                        'yii\web\HttpException:404',
                    ],
                ],
                'debug' => [
                    'levels' => ['info'],
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['debug.dump'],
                    'logVars' => [],
                    'logFile' => '@app/runtime/logs/dump.log',
                ],

            ]
        ]
    ],
];
