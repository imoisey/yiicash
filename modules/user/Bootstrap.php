<?php

namespace app\modules\user;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    /**
     * {@inheritdoc}
     */
    public function bootstrap($app)
    {
        $app->i18n->translations['modules/user/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'forceTranslation' => true,
            'basePath' => '@app/modules/user/messages',
            'fileMap' => [
                'modules/user/module' => 'module.php'
            ],
        ];
    }
}
