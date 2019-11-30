<?php

namespace app\modules\main\models;

use yii\db\ActiveRecord;

class Operation extends ActiveRecord
{
    public static function tableName()
    {
        return 'operation';
    }

    public function getEvent()
    {
        $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    public function getEmployeer()
    {
        $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}