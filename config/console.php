<?php

$config = [
    'id' => 'app-console',
    'controllerNamespace' => 'app\commands',
    'modules' => [
        'main' => [
            'class' => 'app\modules\main\Module',
            'controllerNamespace' => 'app\modules\main\commands'
        ],
        'user' => [
            'class' => 'app\modules\user\Module',
            'controllerNamespace' => 'app\modules\user\commands'
        ],
    ],
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
