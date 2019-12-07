<?php

namespace app\modules\main\models;

use yii\db\ActiveRecord;
use app\modules\user\models\User;

class Limit extends ActiveRecord
{
    public static function tableName()
    {
        return "{{%limits}}";
    }

    public static function primaryKey()
    {
        return ['user_id'];
    }

    public function rules()
    {
        return [
            [['user_id', 'award', 'penalty'], 'required'],
            ['user_id', 'exist', 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['award', 'penalty'], 'compare', 'compareValue' => 0, 'operator' => '>'],
        ];
    }

    public static function create($userId, $award, $penalty)
    {
        $limit = new self();
        $limit->user_id = $userId;
        $limit->award = $award;
        $limit->penalty = $penalty;

        return $limit;
    }
}