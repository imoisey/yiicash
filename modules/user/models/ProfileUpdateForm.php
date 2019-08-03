<?php

namespace app\modules\user\models;

use Yii;
use yii\base\Model;
use ReflectionClass;
use ReflectionProperty;
use app\modules\user\models\User;

class ProfileUpdateForm extends Model
{
    /** @var string $firtname */
    public $firstname;

    /** @var string $lastname */
    public $lastname;

    /** @var string $username */
    public $username;

    /** @var string $email */
    public $email;

    /**
     * @var User
     */
    private $user;

    public function __construct(User $user, $config = [])
    {
        $this->user = $user;
        
        // Присваиваем значения атрибутам
        foreach ($this->attributes() as $propertyName) {
            if (isset($this->user->$propertyName)) {
                $this->$propertyName = $this->user->$propertyName;
            }
        }

        parent::__construct($config);
    }

    public function attributeLabels()
    {
        return $this->user->attributeLabels();
    }

    public function rules()
    {
        return [
            ['username', 'required'],
            ['username', 'match', 'pattern' => '#^[\w_-]+$#is'],
            ['username', 'unique', 'targetClass' => User::className(),
                'message' => Yii::t('app', 'This {name} has already been taken.', [
                    'name' => $this->attributeLabels()['username']
                ]),
                'filter' => ['<>', 'id', $this->user->id],
            ],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['firstname', 'required'],
            ['firstname', 'string', 'min' => 2, 'max' => 255],

            ['lastname', 'required'],
            ['lastname', 'string', 'min' => 2, 'max' => 255],

            ['email', 'required'],
            ['email', 'email'],
            [
                'email',
                'unique',
                'targetClass' => User::className(),
                'message' => Yii::t('app', 'This {name} has already been taken.', [
                    'name' => $this->attributeLabels()['email']
                ]),
                'filter' => ['<>', 'id', $this->user->id],
            ],
            ['email', 'string', 'max' => 255],
        ];
    }

    /**
     * Выполняет обновление данных
     *
     * @return bool
     */
    public function update()
    {
        if ($this->validate()) {
            return $this->updateUserProperties();
        }

        return false;
    }

    /**
     * Выполняет присваивание аттрибутов модели User и сохраняет ее
     *
     * @return bool
     */
    protected function updateUserProperties()
    {
        $user = $this->user;
        foreach ($this->attributes() as $propertyName) {
            if (isset($user->$propertyName)) {
                $user->$propertyName = $this->$propertyName;
            }
        }
        return $user->save();
    }
}
