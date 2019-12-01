<?php

namespace app\assets;

use yii\web\AssetBundle;

class EventAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'js/event.js'
    ];

    public $depends = [
        'app\assets\AppAsset',
    ];
}
