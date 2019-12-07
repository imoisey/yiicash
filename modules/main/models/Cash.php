<?php

namespace app\modules\main\models;

use Yii;
use yii\base\Model;

class Cash
{
    private $total = null;

    public function getTotalAvailable()
    {
        if ($this->total == null) {
            $this->total = Yii::$app->db->createCommand(
                "SELECT SUM(IF(type = '-', amount, - amount)) as totalSum FROM {{%operation}}"
            )->queryScalar();
        }

        return $this->total ? $this->total : 0;
    }

    public function getStatusAvailable()
    {
        return $this->getTotalAvailable() > 0 ? 'success' : 'danger';
    }
}
