<?php

namespace app\modules\user\models;

use yii\db\Expression;
use yii\db\ActiveQuery;

class UserQuery extends ActiveQuery
{
    /**
     * Возвращает активных пользователей
     *
     * @param int $state
     * @return $this
     */
    public function active($state = User::STATUS_ACTIVE)
    {
        return $this->andWhere(['status' => $state]);
    }

    /**
     * Возвращает массив для вывода всех пользователей в Select
     *
     * @return void
     */
    public function getAllBySelect()
    {
        $fullname = new Expression('CONCAT_WS(" ", {{%user}}.lastname, {{%user}}.firstname, " ") as fullName');

        return $this
                ->select([$fullname, 'id'])
                ->indexBy('id')
                ->column();
    }
}
