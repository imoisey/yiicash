<?php

use yii\helpers\Html;
use kartik\date\DatePicker;
use app\modules\main\Module;
use yii\helpers\ArrayHelper;
use app\modules\user\models\User;
use yii\widgets\ActiveForm;

?>
<div class="panel panel-default events-filter">
  <div class="panel-heading"><?= Module::t('module', 'Filter') ?></div>
  <div class="panel-body">

    <?php
        $filterForm = ActiveForm::begin([
            'method' => 'get',
            'action' => ['events/index'],
            'options' => [
                'class' => 'form-horizontal'
            ]
        ]);
    ?>

        <div class="form-group">
            <label for="filterDate" class="col-sm-1 control-label"><?= Module::t('module', 'Period') ?></label>
            <div class="col-sm-11">
            <?= DatePicker::widget([
                'name' => 'from_date',
                'value' => $modelEventSearch->from_date ?? '01' . date(".m.Y"),
                'type' => DatePicker::TYPE_RANGE,
                'name2' => 'to_date',
                'value2' => $modelEventSearch->to_date ?? date("d.m.Y"),
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy'
                ]
            ]); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="filterUser" class="col-sm-1 control-label"><?= Module::t('module', 'Employeer') ?></label>
            <div class="col-sm-11">
                <?= $filterForm->field($modelEventSearch, 'employeer_id', [
                    'options' => [
                        'tag' => false
                    ]
                ])->dropDownList($modelEventSearch->getEmployeerList(), [
                        'class' => 'form-control',
                        'prompt' => Module::t('module', 'Select Employeer')
                    ]
                )->label(false)?>
            </div>
        </div>

        <?= Html::submitButton(Module::t('module', 'Search'), [
            'class' => 'btn btn-primary pull-right'
        ]) ?>

    <?php ActiveForm::end() ?>
  </div>
</div>

<hr>