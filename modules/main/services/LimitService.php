<?php

namespace app\modules\main\services;

use app\modules\main\models\Limit;
use app\modules\main\forms\limits\LimitForm;

class LimitService
{
    public function update(LimitForm $form)
    {
        foreach($form->limits as $userId => $l) {
            $limit = Limit::findOne($userId) ?? Limit::create($userId, $l['award'], $l['penalty']);
            $limit->award = $l['award'];
            $limit->penalty = $l['penalty'];

            if($limit->validate()) {
                $limit->save();
            }
        }

        return true;
    }
}