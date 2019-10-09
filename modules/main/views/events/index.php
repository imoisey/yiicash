<?php

/* @var $this yii\web\View */

use app\assets\EventAsset;

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
                <form action="#" class="needs-validation" method="post" id="eventAddForm" novalidate>
                <div class="row">
                    <div class="col-md-6">
                        <h5>Операции</h5>
                        <p data-operation-message>Нет операций</p>
                        <ul class="list-group event-operation-list"></ul>
                    </div>
                    <div class="col-md-6">
                        <h5>Добавить операцию</h5>
                        
                        <div class="radio">
                            <label>
                                <input type="radio" name="type" data-field-type value="-" checked>
                                Штраф
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="type" data-field-type value="+">
                                Премия
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="eventAmout">Сумма</label>
                            <input type="text" class="form-control" data-field-amount id="eventAmout" autocomplete="off" placeholder="50" step="50" required>
                            <span class="help-block">Сумма должна быть кратна 50</span>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="eventEmployee">Сотрудник</label>
                            <select class="form-control" data-field-employee required>
                                <option value="1">Иванов Иван</option>
                                <option value="2">Петрова Анна</option>
                            </select>
                            <span class="help-block"></span>
                        </div>
                        <button type="submit" class="btn btn-success">Добавить</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <div class="form-group">
                            <label for="eventEmployee">Комментарий</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <button class="btn btn-primary pull-right">Выписать</button>
                    </div>
                </div>
                </form>
            </div>
    </div>
        </div>
    </div>


<script id="EventFormModule-Template-Item" type="text/tpl">
<li class="list-group-item" data-operation-item>
    <input type="hidden" name="Operation[]['type']" value="{type}">
    <input type="hidden" name="Operation[]['amount']" value="{amount}">
    <input type="hidden" name="Operation[]['employee']" value="{employeeId}">
    <button class="btn btn-xs btn-danger" data-operation-remove>
        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
    </button> 
    {type}{amount}р., {employeeName}
</li>
</script>
    
</div>
