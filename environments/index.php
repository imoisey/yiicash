<?php

return [
    'Development' => [
        'path' => 'dev',
        'setWritable' => [
            'runtime',
            'web/assets',
        ],
        'setExecutable' => [
            'yii',
            'tests/bin/yii',
        ],
        'setCookieValidationKey' => [
            'config/web-local.php',
        ],
    ],
    'Production' => [
        'path' => 'prod',
        'setWritable' => [
            'runtime',
            'web/assets',
        ],
        'setExecutable' => [
            'yii',
        ],
        'setCookieValidationKey' => [
            'config/web-local.php',
        ],
    ],
];