<?php

return [
    'components' => [
        'request' => [
            'cookieValidationKey' => 'xQ8jsI1Z_hRZ8aZF4ccwTCsbwn7Lb1Up',
        ],
        'assetManager' => [
            'linkAssets' => true,
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error'],
                    'logFile' => '@app/runtime/logs/web-error.log'
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['warning'],
                    'logFile' => '@app/runtime/logs/web-warning.log'
                ],
            ],
        ],
    ],
];
