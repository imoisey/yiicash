<?php

namespace app\modules\main\controllers;

use Yii;
use yii\web\Controller;
use app\modules\main\Module;
use app\modules\user\models\User;
use app\modules\main\services\LimitService;
use app\modules\main\forms\limits\LimitForm;
use yii\helpers\VarDumper;

class LimitsController extends Controller
{
    private $limitService;

    public function __construct($id, $module, LimitService $limitService, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->limitService = $limitService;
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

    public function actionIndex()
    {
        $limitForm = new LimitForm();

        if($limitForm->load(Yii::$app->request->post()) && $limitForm->validate()) {
            $this->limitService->update($limitForm);
            Yii::$app->session->setFlash("success", Module::t('module', 'Limits successfully added'));
            return $this->redirect(['limits/index']);
        }

        $provider = $limitForm->getDataProvider();

        return $this->render('index', [
            'provider' => $provider,
        ]);
    }
}