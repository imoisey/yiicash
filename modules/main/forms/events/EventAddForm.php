<?php

namespace app\modules\main\forms\events;

use app\modules\main\models\Operation;
use yii\base\Model;
use app\modules\main\Module;
use yii\helpers\ArrayHelper;
use app\modules\user\models\User;
use Yii;

class EventAddForm extends Model
{
    public $operations;
    public $content;

    public function rules()
    {
        return [
            ['operations', 'required'],
            ['content', 'required'],

            ['operations', 'validateLimits', 'when' => function($model) {
                return !Yii::$app->getUser()->can(User::ROLE_ADMIN);
            }]
        ];
    }

    public function attributeLabels()
    {
        return [
            'operations' => Module::t('module', 'Operations'),
            'content' => Module::t('module', 'Comment'),
        ];
    }

    public function getEmployeers()
    {
        return User::find()->getAllWithoutMeBySelect();
    }

    public function validateLimits($attribute, $params)
    {
        if(!is_array($this->$attribute)) {
            return true;
        }

        /** @var User */
        $user = Yii::$app->getUser()->identity;

        $balanceAward = $user->getBalanceAwards() - $this->calc($this->$attribute, Operation::TYPE_PLUS);
        $balancePenalty = $user->getBalancePenalty() - $this->calc($this->$attribute, Operation::TYPE_MINUS);

        if($balanceAward < 0) {
            $this->addError($attribute, Module::t('module', 'Monthly bonus limit exceeded'));
        }

        if($balancePenalty < 0) {
            $this->addError($attribute, Module::t('module', 'Monthly penalty limit exceeded'));
        }
    }

    public function calc($operations, $type = Operation::TYPE_PLUS)
    {
        $total = 0;
        foreach($operations as $operation) {
            if($operation['type'] === $type) {
                $total += $operation['amount'];
            }
        }
        return $total;
    }
}
