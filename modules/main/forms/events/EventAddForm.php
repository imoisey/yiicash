<?php

namespace app\modules\main\forms\events;

use yii\base\Model;
use app\modules\main\Module;

class EventAddForm extends Model
{
    public $operations;
    public $content;

    public function rules()
    {
        return [
            ['operations', 'required'],
            ['content', 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'operations' => Module::t('module', 'Operations'),
            'content' => Module::t('module', 'Comment'),
        ];
    }
}
