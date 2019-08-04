<?php

use yii\helpers\Html;
use app\modules\main\Module as MainModule;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = MainModule::t('module','Create');
$this->params['breadcrumbs'][] = ['label' => MainModule::t('module','Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
