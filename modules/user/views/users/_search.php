<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\user\Module as UserModule;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'firstname') ?>

    <?= $form->field($model, 'lastname') ?>

    <?= $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'lastname')?>

    <?php // echo $form->field($model, 'auth_key')?>

    <?php // echo $form->field($model, 'password_hash')?>

    <?php // echo $form->field($model, 'password_reset_token')?>

    <?php // echo $form->field($model, 'email')?>

    <?php // echo $form->field($model, 'status')?>

    <div class="form-group">
        <?= Html::submitButton(UserModule::t('module', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(UserModule::t('module', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
