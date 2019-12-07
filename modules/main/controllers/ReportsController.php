<?php

namespace app\modules\main\controllers;

use Yii;
use yii\web\Controller;
use app\modules\main\forms\reports\ReportForm;

class ReportsController extends Controller
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
        $model = new ReportForm();
        $model->load(Yii::$app->request->get());

        $provider = $model->getDataProvider();
        
        return $this->render('index', [
            'model' => $model,
            'provider' => $provider
        ]);
    }
}
