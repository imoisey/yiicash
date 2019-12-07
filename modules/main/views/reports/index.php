<?php

/* @var $this yii\web\View */

use Yii;
use yii\grid\GridView;
use yii\bootstrap\Alert;
use app\modules\main\Module;

$this->title = Yii::$app->name;
?>
<div class="main-reports-index">
    <h3 class="events-title"><?= Module::t('module', 'Reports') ?></h3>

    <?php include "_search.php" ?>

    <?php if ($provider->getTotalCount() > 0) : ?>
        <hr>
        <h4 class="text-center"><?= Module::t('module', 'Period from to', [
                'from_date' => $model->from_date,
                'to_date' => $model->to_date
            ])?>
        </h4>
        <?= GridView::widget([
            'dataProvider' => $provider,
            'columns' => [
                [
                    'attribute' => 'fullname',
                    'label' => Module::t('module', 'Fullname')
                ],
                [
                    'attribute' => 'total',
                    'label' => Module::t('module', 'Total')
                ]
            ]
        ]);?>
    <?php else :?>
        <?= Alert::widget([
            'body' => Module::t('module', 'Specify the period for generating the report'),
            'options' => [
                'class' => 'alert-info',
            ],
            'closeButton' => false
        ]); ?>
    <?php endif; ?>
</div>
