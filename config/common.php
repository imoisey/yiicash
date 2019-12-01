<?php

use app\modules\main\models\Cash;
use app\modules\main\services\EventService;
use yii\helpers\ArrayHelper;

$params = ArrayHelper::merge(
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'name' => 'ИС КассаШтрафов',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'app\modules\main\Bootstrap',
        'app\modules\user\Bootstrap'
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'charset' => 'utf8',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'main/events/index',
                '<_a:(error)>' => 'main/events/<_a>',
                '<_a:(login|logout|password-reset-request|password-reset)>' => 'user/default/<_a>',

                'users' => 'user/users/index',
                'users/<_a:[\w\-]+>' => 'user/users/<_a>',

                'events' => 'main/events/index',
                'events/<_a:[\w\-]+>' => 'main/events/<_a>',

                '<_m:[\w\-]+>' => '<_m>/events/index',
                '<_m:[\w\-]+>/<id:\d+>' => '<_m>/events/view',
                '<_m:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_m>/events/<_a>',
                '<_m:[\w\-]+>/<_c:[\w\-]+>' => '<_m>/<_c>/index',
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>' => '<_m>/<_c>/view',
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>/' => '<_m>/<_c>/<_a>',
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<_a:[\w\-]+>' => '<_m>/<_c>/<_a>',
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
        ],
        'cache' => [
            'class' => 'yii\caching\DummyCache',
        ],
        'log' => [
            'class' => 'yii\log\Dispatcher',
        ],
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                ],
            ],
        ],
        'formatter' => [
            'dateFormat' => 'dd.MM.yyyy',
            'datetimeFormat' => 'dd.MM.yyyy H:m',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'RUB',
       ],
    ],
    'container' => [
        'singletons' => [
            EventService::class => [
                ['class' => EventService::class]
            ],
            Cash::class => [
                ['class' => Cash::class]
            ]
        ],
    ],
    'params' => $params,
];
