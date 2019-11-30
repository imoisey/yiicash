<?php

namespace app\modules\main\models;

use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Event extends ActiveRecord
{
    public function behaviors()
    {
        return [
            TimestampBehavior::class => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => null,
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    public static function tableName()
    {
        return 'event';
    }

    public static function create($authorId, $content, $total = 0)
    {
        $event = new self();
        $event->author_id = $authorId;
        $event->content = $content;
        $event->total = $total;
        return $event;
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