<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\Html;
use app\assets\EventAsset;
use yii\widgets\ActiveForm;
use app\modules\main\Module;
use yii\helpers\ArrayHelper;
use app\modules\user\models\User;
use app\components\grid\ActionColumn;

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
            <ul class="media-list event-list">
                <li class="media event-item">
                    <div class="media-left">
                        <img class="media-object img-circle" src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?d=identicon" alt="...">
                        <a href="#" class="text-center center-block">#110</a>
                    </div>
                    <div class="media-body">
                        <h5 class="media-heading">Игорь Моисеев</h5>
                        <p class="small">23.09.2019 в 14:55</p>
                        <p>Затягивание. https://stena.worksection.com/project/56305/518836/9354575/</p>
                        <ul class="list-group event-operation">
                            <li class="list-group-item event-operation-minus">
                                -100р., Мельников Никита
                            </li>
                            <li class="list-group-item event-operation-plus">
                                +100р., Мельников Никита
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="media event-item">
                    <div class="media-left">
                        <img class="media-object img-circle" src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?d=identicon" alt="...">
                        <a href="#" class="text-center center-block">#110</a>
                    </div>
                    <div class="media-body">
                        <h5 class="media-heading">Игорь Моисеев</h5>
                        <p class="small">23.09.2019 в 14:55</p>
                        <p>Затягивание. https://stena.worksection.com/project/56305/518836/9354575/</p>
                        <ul class="list-group event-operation">
                            <li class="list-group-item event-operation-minus">
                                -100р., Мельников Никита
                            </li>
                            <li class="list-group-item event-operation-plus">
                                +100р., Мельников Никита
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="media event-item">
                    <div class="media-left">
                        <img class="media-object img-circle" src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?d=identicon" alt="...">
                        <a href="#" class="text-center center-block">#110</a>
                    </div>
                    <div class="media-body">
                        <h5 class="media-heading">Игорь Моисеев</h5>
                        <p class="small">23.09.2019 в 14:55</p>
                        <p>Затягивание. https://stena.worksection.com/project/56305/518836/9354575/</p>
                        <ul class="list-group event-operation">
                            <li class="list-group-item event-operation-minus">
                                -100р., Мельников Никита
                            </li>
                            <li class="list-group-item event-operation-plus">
                                +100р., Мельников Никита
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

            <nav aria-label="Page navigation" class="text-center">
            <ul class="pagination">
                <li>
                <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
                </li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li>
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
                </li>
            </ul>
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

                            <?= Html::DropDownList('user_id', null, ArrayHelper::map(User::findAll(1), 'id', 'fullname'), [
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
    <input type="hidden" name="OperationForm[{index}]type" value="{type}">
    <input type="hidden" name="OperationForm[{index}]amount" value="{amount}">
    <input type="hidden" name="OperationForm[{index}]user_id" value="{employeeId}">
    <button class="btn btn-xs btn-danger" data-operation-remove>
        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
    </button> 
    {type}{amount}р., {employeeName}
</li>
</script>
    
</div>
