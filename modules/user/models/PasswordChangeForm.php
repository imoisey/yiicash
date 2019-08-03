<?php

namespace app\modules\user\models;

use Yii;
use yii\base\Model;
use app\modules\user\models\User;

class PasswordChangeForm extends Model
{
    /** @var string $currentPassword */
    public $currentPassword;

    /** @var string $newPassword */
    public $newPassword;

    /** @var string $newPasswordRepeat */
    public $newPasswordRepeat;

    /**
     * @var User
     */
    private $user;

    public function __construct(User $user, $config = [])
    {
        $this->user = $user;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['currentPassword', 'newPassword', 'newPasswordRepeat'], 'required'],
            ['currentPassword', 'currentPassword'],
            ['newPassword', 'string', 'min' => 6],
            ['newPasswordRepeat', 'compare', 'compareAttribute' => 'newPassword']
        ];
    }

    public function attributeLabels()
    {
        return [
            'currentPassword' => Yii::t('app', 'Current Password'),
            'newPassword' => Yii::t('app', 'New Password'),
            'newPasswordRepeat' => Yii::t('app', 'New Password Repeat'),
        ];
    }

    /**
     * @param string $attribute
     * @param array $params
     */
    public function currentPassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (!$this->user->validatePassword($this->$attribute)) {
                $this->addError($attribute, Yii::t('app', 'Current password is incorrect'));
            }
        }
    }

    /**
     * @return bool
     */
    public function changePassword()
    {
        if ($this->validate()) {
            $user = $this->user;
            $user->setPassword($this->newPassword);
            return $user->save();
        }

        return false;
    }
}
