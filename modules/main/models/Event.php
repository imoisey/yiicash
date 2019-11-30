<?php

namespace app\modules\main\models;

use yii\db\ActiveRecord;

class Event extends ActiveRecord
{
    public static function tableName()
    {
        return 'event';
    }

    public function getOperations()
    {
        $this->hasMany(Operation::className(), ['event_id' => 'id']);
    }

    public function getAuthor()
    {
        $this->hasOne(User::className(), ['user_id' => 'id']);
    }
}