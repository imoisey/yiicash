<?php

namespace app\modules\user\models\backend;

use Yii;
use yii\helpers\ArrayHelper;
use app\modules\user\Module as UserModule;

class User extends \app\modules\user\models\User
{
    const SCENARIO_ADMIN_CREATE = 'adminCreate';
    const SCENARIO_ADMIN_UPDATE = 'adminUpdate';

    public $newPassword;
    public $newPasswordRepeat;

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['newPassword', 'newPasswordRepeat'], 'required', 'on' => self::SCENARIO_ADMIN_CREATE],
            ['newPassword', 'string', 'min' => '6'],
            ['newPasswordRepeat', 'compare', 'compareAttribute' => 'newPassword']
        ]);
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_ADMIN_CREATE] = [
            'firstname',
            'lastname',
            'username',
            'email',
            'status',
            'newPassword',
            'newPasswordRepeat'
        ];

        $scenarios[self::SCENARIO_ADMIN_UPDATE] = [
            'firstname',
            'lastname',
            'username',
            'email',
            'status',
            'newPassword',
            'newPasswordRepeat'
        ];

        return $scenarios;
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'newPassword' => UserModule::t('module', 'New Password'),
            'newPasswordRepeat' => UserModule::t('module', 'New Password Repeat')
        ]);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!empty($this->newPassword)) {
                $this->setPassword($this->newPassword);
            }

            return true;
        }

        return false;
    }
}
