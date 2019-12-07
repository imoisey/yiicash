<?php

namespace app\modules\main\forms\limits;

use Yii;
use yii\base\Model;
use app\modules\main\Module;
use app\modules\user\models\User;
use app\modules\main\models\Limit;
use yii\data\ActiveDataProvider;
use yii\db\Query;

class LimitForm extends Model
{
    public $limits;

    public function rules()
    {
        return [
            ['limits', 'required'],
            ['limits', 'validateLimits']
        ];
    }

    public function validateLimits()
    {
        if(!is_array($this->limits)) {
            $this->addError('limits', Module::t('module', 'Limits is not array'));
            return false;
        }

        foreach($this->limits as $limit) {
            if(!isset($limit['award']) || !isset($limit['penalty'])) {
                $this->addError('limits', Module::t('module', 'Incorrect value limits'));
                return false;
            } 
        }

        return true;
    }

    public function load($data, $formName = null)
    {
        $formName = $formName ?? $this->formName();
        if(!isset($data[$formName])) {
            return false;
        }

        foreach($data[$formName] as $userId => $item) {
            $this->limits[$userId] = $item;
        }

        return true;
    }

    public function getDataProvider()
    {
        $limits = (new Query())
                    ->select([
                        "u.id",
                        "CONCAT(u.firstname, ' ', u.lastname) as fullname",
                        "l.award",
                        "l.penalty"
                    ])
                    ->from(User::tableName() . ' u')
                    ->leftJoin(Limit::tableName() . ' l', "l.user_id = u.id")
                    ->where(['!=', 'role', User::ROLE_ADMIN]);
        
        return new ActiveDataProvider([
            'query' => $limits
        ]);
    }

}