<?php

namespace app\modules\main\controllers;

use Yii;
use yii\web\Controller;
use app\modules\main\forms\events\EventAddForm;
use app\modules\main\forms\events\OperationForm;

/**
 * Default controller for the `main` module
 */
class EventsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $eventForm = new EventAddForm();
        $operationForm = new OperationForm();

        return $this->render('index', [
            'eventForm' => $eventForm,
            'operationForm' => $operationForm
        ]);
    }

    public function actionCreate()
    {
        $eventForm = new EventAddForm();
        $operationForm = new OperationForm();

        $eventForm->load(Yii::$app->request->post());
        $operationForm->load(Yii::$app->request->post());

        var_dump(Yii::$app->request->post());

        // $count = count(Yii::$app->request->post('OperationForm', []));
        // $operations = [new Operation()];
        // for($i = 1; $i < $count; $i++) {
        //     $operations[] = new Operation();
        // }

        // $eventForm->load(Yii::$app->request->post());
        // $operationForm->load(Yii::$app->request->post());

        // if (Model::loadMultiple($operations, $operationForm->operations) && Model::validateMultiple($operations)) {
        //     foreach ($operations as $operation) {
        //         $operation->event_id = $eventForm->event_id;
        //         $operation->save(false);
        //     }
            
        //     return $this->redirect('index');
        // }

    }
}
