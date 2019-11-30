<?php

namespace app\modules\main\forms\events;

use yii\base\Model;
use app\modules\main\Module;

class OperationForm extends Model
{
    public $type;
    public $amount;
    public $user_id;

    public function rules()
    {
        return [
            ['type', 'required'],
            ['amount', 'required'],
            ['user_id', 'required'],             
        ];
    }

    public function attributeLabels()
    {
        return [
            'type' => Module::t('module', 'Type'),
            'amount' => Module::t('module', 'Amount'),
            'user_id' => Module::t('module', 'Employeer')
        ];
    }
}