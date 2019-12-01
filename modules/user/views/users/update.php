<?php

use yii\helpers\Html;
use app\modules\user\Module as UserModule;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = UserModule::t('module', 'Update: {name}', [
    'name' => $model->fullname,
]);
$this->params['breadcrumbs'][] = ['label' => UserModule::t('module', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fullname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = UserModule::t('module', 'Update');
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
