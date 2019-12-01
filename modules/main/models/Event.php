<?php

namespace app\modules\main\models;

use yii\db\Expression;
use yii\db\ActiveRecord;
use app\modules\user\models\User;
use yii\behaviors\TimestampBehavior;
use app\modules\main\models\Operation;

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
        return $this->hasMany(Operation::className(), ['event_id' => 'id']);
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }
}