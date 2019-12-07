<?php

/* @var $this yii\web\View */

use Yii;
use yii\grid\GridView;
use yii\bootstrap\Alert;
use app\modules\main\Module;
use kartik\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::$app->name;
$this->title = Module::t('module', 'Limits');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-limits-index">
    <h1 class="events-title"><?= $this->title ?></h1>

    <?php $form = ActiveForm::begin([]); ?>

    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [
            [
                'attribute' => 'fullname',
                'label' => Module::t('module', 'Fullname')
            ],
            [
                'attribute' => 'award',
                'label' => Module::t('module', 'Award'),
                'format' => 'raw',
                'value' => function($model) {
                    $value = $model['award'] ?? Yii::$app->params['limit.award'];
                    return Html::textInput("LimitForm[$model[id]][award]", $value, [
                        'class' => 'form-control'
                    ]);
                }
            ],
            [
                'attribute' => 'penalty',
                'label' => Module::t('module', 'Penalty'),
                'format' => 'raw',
                'value' => function($model) {
                    $value = $model['penalty'] ?? Yii::$app->params['limit.penalty'];
                    return Html::textInput("LimitForm[$model[id]][penalty]", $value, [
                        'class' => 'form-control'
                    ]);
                }
            ]
        ]
    ]); ?>

    <?= Html::submitButton(Module::t('module', 'Save'), [
        'class' => 'btn btn-primary',
    ]) ?>

    <?php ActiveForm::end(); ?>
</div>
