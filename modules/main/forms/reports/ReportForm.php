<?php

namespace app\modules\main\forms\reports;

use Yii;
use yii\db\Query;
use yii\base\Model;
use app\modules\main\Module;
use yii\data\ActiveDataProvider;
use app\modules\user\models\User;
use app\modules\main\models\Event;
use app\modules\main\models\Operation;

class ReportForm extends Model
{
    public $from_date;
    public $to_date;

    public function rules()
    {
        return [
            [['from_date', 'to_date'], 'required'],
            [['from_date', 'to_date'], 'date', 'format' => 'php:d.m.Y']
        ];
    }

    public function attributeLabels()
    {
        return [
            'user_id' => Module::t('module', 'User Id'),
            'fullname' => Module::t('module', 'Fullname'),
            'total' => Module::t('module', 'Total')
        ];
    }

    public function formName()
    {
        return '';
    }

    public function getDataProvider()
    {
        $operation = (new Query())
            ->select([
                "user_id",
                "CONCAT(u.firstname, ' ', u.lastname) as fullname",
                "SUM(IF(type = '+', amount, -amount)) as total"
            ])
            ->from(Operation::tableName() . ' o')
            ->leftJoin(Event::tableName() . ' e', "o.event_id = e.id")
            ->leftJoin(User::tableName() . ' u', 'u.id = o.user_id')
            ->where(['>=', 'e.created_at', Yii::$app->formatter->asDatetime($this->from_date, 'php:Y-m-d 00:00:00')])
            ->andWhere(['<=', 'e.created_at', Yii::$app->formatter->asDatetime($this->to_date, 'php:Y-m-d 23:59:59')])
            ->groupBy(['user_id']);

        return new ActiveDataProvider([
            'query' => $operation,
            'sort' => [
                'attributes' => [
                    'total' => [
                        'asc' => ['total' => SORT_ASC],
                        'desc' => ['total' => SORT_DESC],
                    ],
                ],
            ]
        ]);
    }
}
