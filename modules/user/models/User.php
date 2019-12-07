<?php

namespace app\modules\user\models;

use Yii;
use app\modules\user\Module as UserModule;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property string $username
 * @property string $firstname
 * @property string $lastname
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    const STATUS_BLOCKED = 0;
    const STATUS_ACTIVE = 1;

    const ROLE_ADMIN = 'admin';
    const ROLE_EMPLOYEER = 'employeer';

    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'required'],
            ['username', 'match', 'pattern' => '#^[\w_-]+$#is'],
            ['username', 'unique', 'targetClass' => self::className(),
                'message' => Yii::t('app', 'This {name} has already been taken.', [
                    'name' => $this->attributeLabels()['username']
                ]),
                'filter' => ['<>', 'id', $this->id],
            ],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['firstname', 'required'],
            ['firstname', 'string', 'min' => 2, 'max' => 255],

            ['lastname', 'required'],
            ['lastname', 'string', 'min' => 2, 'max' => 255],

            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => self::className(),
                'message' => Yii::t('app', 'This {name} has already been taken.', [
                    'name' => $this->attributeLabels()['email'],
                ]),
                'filter' => ['<>', 'id', $this->id],
            ],
            ['email', 'string', 'max' => 255],

            ['status', 'integer'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => array_keys(self::getStatusesArray())],

            ['role', 'string'],
            ['role', 'default', 'value' => self::ROLE_EMPLOYEER],
            ['role', 'in', 'range' => array_keys(self::getRolesArray())]

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => UserModule::t('module', 'Create At'),
            'updated_at' =>  UserModule::t('module', 'Update At'),
            'fullname' =>  UserModule::t('module', 'Full Name'),
            'username' =>  UserModule::t('module', 'Username'),
            'firstname' =>  UserModule::t('module', 'Firstname'),
            'lastname' =>  UserModule::t('module', 'Lastname'),
            'email' =>  UserModule::t('module', 'Email'),
            'status' => UserModule::t('module', 'Status Name'),
            'statusname' =>  UserModule::t('module', 'Status Name'),
            'role' => UserModule::t('module', 'Role Name'),
        ];
    }

    public function getFullName()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    public function getRoleName()
    {
        return self::getRolesArray()[$this->role];
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token, $timeout)
    {
        if (!static::isPasswordResetTokenValid($token, $timeout)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token, $timeout)
    {
        if (empty($token)) {
            return false;
        }
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $timeout >= time();
    }

    /**
    * Generates new password reset token
    */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
 
    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->generateAuthKey();
            }
            return true;
        }
        return false;
    }

    /**
     * Возвращает имя статуса пользователя
     *
     * @return string
     */
    public function getStatusName()
    {
        return ArrayHelper::getValue(self::getStatusesArray(), $this->status);
    }

    /**
     * Возвращает массив всех статусов
     *
     * @return array
     */
    public static function getStatusesArray()
    {
        return [
            self::STATUS_BLOCKED => 'Заблокирован',
            self::STATUS_ACTIVE => 'Активен'
        ];
    }

    public static function getRolesArray()
    {
        return [
            self::ROLE_ADMIN => 'Администратор',
            self::ROLE_EMPLOYEER => 'Сотрудник',
        ];
    }

    /**
     * Возвращет ссылку на граватор
     *
     * @param string $d
     * @return string
     */
    public function getGravatar($d = 'identicon')
    {
        return sprintf(
            "https://www.gravatar.com/avatar/%s?d=%s",
            md5(strtolower($this->email)),
            $d
        );
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }
    
    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('findIdentityByAccessToken is not implemented.');
    }
 
    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
 
    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
}
