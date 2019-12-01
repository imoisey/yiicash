<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\user\Module as UserModule;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = "{$model->fullname}";
$this->params['breadcrumbs'][] = ['label' => UserModule::t('module', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(UserModule::t('module', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(UserModule::t('module', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => UserModule::t('module', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'statusname',
            'username',
            'firstname',
            'lastname',
            'email:email',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
