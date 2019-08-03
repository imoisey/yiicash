<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\main\models\User;
use app\components\grid\SetColumn;
use app\components\grid\ActionColumn;
use kartik\date\DatePicker;
use app\components\grid\LinkColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\main\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'created_at',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'date_from',
                    'attribute2' => 'date_to',
                    'type' => DatePicker::TYPE_RANGE,
                    'separator' => '-',
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'orientation' => 'bottom'
                    ]
                ]),
                'format' => 'datetime'
            ],
            [
                'class' => LinkColumn::className(),
                'attribute' => 'username'
            ],
            'firstname',
            'lastname',
            'email:email',
            [
                'class' => SetColumn::className(),
                'attribute' => 'status',
                'filter' => User::getStatusesArray(),
                'name' => 'statusName',
                'cssClasses' => [
                    User::STATUS_ACTIVE => 'success',
                    User::STATUS_BLOCKED => 'default'
                ]
            ],
            [
                'class' => ActionColumn::className(),
            ],
        ],
    ]); ?>


</div>
