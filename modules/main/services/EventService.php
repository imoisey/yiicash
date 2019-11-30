<?php

namespace app\modules\main\services;

use Yii;
use app\modules\main\models\Event;
use app\modules\main\models\Operation;
use app\modules\main\forms\events\EventAddForm;

class EventService
{
    public function add(EventAddForm $eventForm)
    {
        $authorId = Yii::$app->user->id;
        $total = $this->calcTotal($eventForm->operations);

        $event = Event::create($authorId, $eventForm->content, $total);
        $event->save();

        foreach($eventForm->operations as $operationItem) {
            $operation = Operation::create(
                $event->id, 
                $operationItem['user_id'], 
                $operationItem['type'], 
                $operationItem['amount']
            );
            $operation->save();
        }

        return $event;
    }

    protected function calcTotal($operations)
    {
        $total = 0;
        foreach ($operations as $operationItem) {
            if ($operationItem['type'] == Operation::TYPE_PLUS) {
                $total -= (int) $operationItem['amount'];
            } else {
                $total += (int) $operationItem['amount'];
            }
        }
        return $total;
    }
}