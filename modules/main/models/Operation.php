<?php

namespace app\modules\main\models;

use yii\db\ActiveRecord;
use app\modules\user\models\User;
use app\modules\main\models\Event;

class Operation extends ActiveRecord
{
    const TYPE_PLUS = '+';
    const TYPE_MINUS = '-';

    public static function tableName()
    {
        return 'operation';
    }

    public static function create($eventId, $userId, $type, $amount)
    {
        $operation = new self();
        $operation->event_id = $eventId;
        $operation->user_id = $userId;
        $operation->type = $type;
        $operation->amount = $amount;
        return $operation;
    }

    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    public function getEmployeer()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
