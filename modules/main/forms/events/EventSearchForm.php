<?php

namespace app\modules\main\forms\events;

use Yii;
use yii\base\Model;
use app\modules\main\Module;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use app\modules\user\models\User;
use app\modules\main\models\Event;

class EventSearchForm extends Model
{
    public $from_date;
    public $to_date;
    public $employeer_id;

    public function rules()
    {
        return [
            [['from_date', 'to_date'], 'date', 'format' => 'php:d.m.Y'],
            ['employeer_id', 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'employeer_id' => Module::t('module', 'Employeer')
        ];
    }

    public function formName()
    {
        return '';
    }

    public function getDataProvider()
    {
        $eventQuery = Event::find();

        if ($this->from_date) {
            $eventQuery->andFilterWhere(['>=', 'created_at', Yii::$app->formatter->asDatetime($this->from_date, 'php:Y-m-d 00:00:00')]);
        }

        if ($this->to_date) {
            $eventQuery->andFilterWhere(['<=', 'created_at', Yii::$app->formatter->asDatetime($this->to_date, 'php:Y-m-d 23:59:59')]);
        }

        if ($this->employeer_id) {
            $eventQuery->andFilterWhere(['=', 'author_id', $this->employeer_id]);
        }

        $provider = new ActiveDataProvider([
            'query' => $eventQuery,
            'pagination' => [
                'pageSize' => Yii::$app->params['event.pageSize'],
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ]
        ]);

        return $provider;
    }

    public function getEmployeerList()
    {
        return ArrayHelper::map(
            User::find()->active()->all(),
            'id',
            'fullname'
        );
    }
}
