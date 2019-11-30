<?php

namespace app\modules\main\controllers;

use Yii;
use yii\web\Controller;
use app\modules\main\forms\events\EventAddForm;
use app\modules\main\services\EventService;
use app\modules\main\Module;

/**
 * Default controller for the `main` module
 */
class EventsController extends Controller
{
    private $eventService;

    /**
     * @param EventService $eventService
     */
    public function __construct($id, $module, EventService $eventService, $config = [])
    {
        $this->eventService = $eventService;

        parent::__construct($id, $module, $config);
    }

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

        return $this->render('index', [
            'eventForm' => $eventForm,
        ]);
    }

    public function actionCreate()
    {
        $eventForm = new EventAddForm();
        $eventForm->load(Yii::$app->request->post());

        if($eventForm->load(Yii::$app->request->post()) && $eventForm->validate()) {
            $this->eventService->add($eventForm);
            Yii::$app->session->setFlash("success", Module::t('module', 'Event successfully added'));
            return $this->redirect('index');
        }

        Yii::$app->session->setFlash("danger", Module::t('module', 'Event not added'));
        return $this->redirect('index');
    }
}
