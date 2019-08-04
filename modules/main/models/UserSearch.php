<?php

namespace app\modules\main\models;

use yii\base\Model;
use app\modules\main\Module as MainModule;
use yii\data\ActiveDataProvider;
use app\modules\user\models\User;

/**
 * UserSearch represents the model behind the search form of `app\modules\user\models\User`.
 */
class UserSearch extends Model
{
    public $id;
    public $created_at;
    public $updated_at;
    public $firstname;
    public $lastname;
    public $username;
    public $email;
    public $status;
    public $date_from;
    public $date_to;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['username', 'firstname', 'lastname', 'email'], 'safe'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => MainModule::t('module','Created At'),
            'updated_at' => MainModule::t('module','Updated At'),
            'fistname' => MainModule::t('module','Firstname'),
            'lastname' => MainModule::t('module','Lastname'),
            'username' => MainModule::t('module','Username'),
            'email' => MainModule::t('module','Email'),
            'status' => MainModule::t('module','Status'),
            'date_from' => MainModule::t('module','Date From'),
            'date_to' => MainModule::t('module','Date To')
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['>=', 'created_at',
                $this->date_from
                    ? strtotime($this->date_from . ' 00:00:00')
                    : null
            ])
            ->andFilterWhere(['<=', 'created_at',
                $this->date_to
                    ? strtotime($this->date_to . ' 23:59:59')
                    : null
            ]);

        return $dataProvider;
    }
}
