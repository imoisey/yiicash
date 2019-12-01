<?php

namespace app\modules\main\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\modules\main\Module;
use yii\data\ActiveDataProvider;
use app\modules\main\models\Cash;
use app\modules\main\models\Event;
use app\modules\main\services\EventService;
use app\modules\main\forms\events\EventAddForm;
use app\modules\main\forms\events\EventSearchForm;

/**
 * Default controller for the `main` module
 */
class EventsController extends Controller
{
    /**
     * @var EventService
     */
    private $eventService;

    /**
     * @var Cash
     */
    private $cash;

    /**
     * @param EventService $eventService
     */
    public function __construct($id, $module, EventService $eventService, Cash $cash, $config = [])
    {
        $this->eventService = $eventService;
        $this->cash = $cash;

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
        $eventSearchForm = new EventSearchForm();
        $eventSearchForm->load(Yii::$app->request->get());

        $provider = $eventSearchForm->getDataProvider();

        return $this->render('index', [
            'eventForm' => $eventForm,
            'modelEventSearch' => $eventSearchForm,
            'provider' => $provider,
            'cash' => $this->cash
        ]);
    }

    public function actionCreate()
    {
        $eventForm = new EventAddForm();
        $eventForm->load(Yii::$app->request->post());

        if ($eventForm->load(Yii::$app->request->post()) && $eventForm->validate()) {
            $this->eventService->add($eventForm);
            Yii::$app->session->setFlash("success", Module::t('module', 'Event successfully added'));
            return $this->redirect('index');
        }

        Yii::$app->session->setFlash("danger", Module::t('module', 'Event not added'));
        return $this->redirect('index');
    }
}
