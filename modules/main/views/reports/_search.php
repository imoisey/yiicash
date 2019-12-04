<?php

use yii\helpers\Html;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use app\modules\main\Module;

$filterForm = ActiveForm::begin([
    'method' => 'get',
    'action' => ['reports/index'],
    'options' => [
        'class' => 'form-horizontal'
    ]
]);
?>

<div class="panel panel-default events-filter">
  <div class="panel-heading"><?= Module::t('module', 'Filter') ?></div>
  <div class="panel-body">

<div class="form-group">
    <label for="filterDate" class="col-sm-1 control-label"><?= Module::t('module', 'Period') ?></label>
    <div class="col-sm-9">
    <?= DatePicker::widget([
        'name' => 'from_date',
        'value' => $model->from_date ?? '01' . date(".m.Y"),
        'type' => DatePicker::TYPE_RANGE,
        'name2' => 'to_date',
        'value2' => $model->to_date ?? date("d.m.Y"),
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd.mm.yyyy'
        ]
    ]); ?>
    </div>
    <div class="col-sm-2">
    <?= Html::submitButton(Module::t('module', 'Submit'), [
        'class' => 'btn btn-primary pull-right'
    ]) ?>
    </div>
</div>

<?php ActiveForm::end() ?>

</div>
</div>
