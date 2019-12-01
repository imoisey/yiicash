<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\Html;
use app\assets\EventAsset;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use app\modules\main\Module;
use yii\helpers\ArrayHelper;
use app\modules\user\models\User;
use app\components\grid\ActionColumn;
use app\modules\main\models\Operation;

EventAsset::register($this);

$this->title = Yii::$app->name;
?>
<div class="main-default-index">
    <h3 class="events-title">Касса взаимопомощи. Премии и штрафы.</h3>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#list" aria-controls="list" role="tab" data-toggle="tab">
                <span class="glyphicon glyphicon-list"></span> Список событий
            </a>
        </li>
        <li role="presentation">
            <a href="#add" aria-controls="add" role="tab" data-toggle="tab">
                <span class="glyphicon glyphicon-plus"></span> Добавить событие
            </a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="list">

            <?php if($provider->getCount() > 0): ?>
            <ul class="media-list event-list">
                <?php foreach($provider->getModels() as $event): ?>
                    <li class="media event-item" id="item<?= $event->id ?>">
                        <div class="media-left">
                            <img class="media-object img-circle" src="<?= $event->author->getGravatar()?>" alt="<?= $event->author->fullName ?>">
                            <a href="#item<?= $event->id ?>" class="text-center center-block">#<?= $event->id ?></a>
                        </div>
                        <div class="media-body">
                            <h5 class="media-heading"><?= $event->author->fullName ?></h5>
                            <p class="small"><?= $event->created_at?></p>
                            <p><?= $event->content ?></p>

                            <ul class="list-group event-operation">
                            <?php foreach($event->operations as $operation): ?>
                                <li class="list-group-item <?= $operation->type == Operation::TYPE_MINUS ? 'event-operation-minus' : 'event-operation-plus'?>">
                                    <?= $operation->type ?><?= $operation->amount ?>р., <?= $operation->employeer->fullname ?>
                                </li>
                            <?php endforeach; ?>
                            </ul>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <nav aria-label="Page navigation" class="text-center">
            <?= LinkPager::widget([
                'pagination' => $provider->getPagination(),
            ]); ?>
            </nav>
        </div>

        <div role="tabpanel" class="tab-pane" id="add">
            <h4>Выписать премию/штраф</h4>
            <div class="panel panel-default">
            <div class="panel-body" id="addEventBlock">

            <?php $form = ActiveForm::begin([
                    'action' => Url::to(['events/create']),
                    'id' => 'eventAddForm',
                    'options' => [
                        'class' => 'needs-validation',
                        'novalidate' => true
                    ]
                ]);
            ?>
                <div class="row">
                    <div class="col-md-6">
                        <h5><?= Module::t('module', 'Operations')?></h5>
                        <p data-operation-message><?= Module::t('module', 'Operations are empty')?></p>
                        <ul class="list-group event-operation-list"></ul>
                    </div>
                    <div class="col-md-6">
                        <h5><?= Module::t('module', 'Add Operation')?></h5>
                        
                        <div class="radio">
                            <label>
                                <input type="radio" name="type" data-field-type value="-" checked>
                                <?= Module::t('module', 'Penalty')?>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="type" data-field-type value="+">
                                <?= Module::t('module', 'Bounty')?>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="eventAmout"><?= Module::t('module', 'Amount')?></label>
                            <input type="text" class="form-control" data-field-amount id="eventAmout" autocomplete="off" placeholder="50" step="50" required>
                            <span class="help-block"><?= Module::t('module', 'Amount must be a multiple of 50')?></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="eventEmployee"><?= Module::t('module', 'Employeer')?></label>

                            <?= Html::DropDownList('user_id', null, ArrayHelper::map(User::find()->active()->all(), 'id', 'fullname'), [
                                'class' => 'form-control',
                                'data-field-employee' => true,
                                'required' => true
                            ]); ?>

                            <span class="help-block"></span>
                        </div>
                        <button type="button" class="btn operationAdd btn-success"><?= Module::t('module', 'Add')?></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <div class="form-group">
                            <?= $form->field($eventForm, 'content')->textarea([
                                'class' => 'form-control',
                                'rows' => 3
                            ]); ?>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Выписать</button>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
    </div>
        </div>
    </div>


<script type="text/javascript">
window.message = {
    notOperation: "<?= Module::t('module', 'Error. Operation not found.')?>",
};
</script>

<script id="EventFormModule-Template-Item" type="text/tpl">
<li class="list-group-item" data-operation-item>
    <input type="hidden" name="EventAddForm[operations][{index}][type]" value="{type}">
    <input type="hidden" name="EventAddForm[operations][{index}][amount]" value="{amount}">
    <input type="hidden" name="EventAddForm[operations][{index}][user_id]" value="{employeeId}">
    <button class="btn btn-xs btn-danger" data-operation-remove>
        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
    </button> 
    {type}{amount}р., {employeeName}
</li>
</script>
    
</div>
