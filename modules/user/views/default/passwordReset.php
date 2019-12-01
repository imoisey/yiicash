<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */
use yii\helpers\Html;
use app\modules\user\Module as UserModule;
use yii\bootstrap\ActiveForm;

$this->title = UserModule::t('module', 'Reset password');
?>
<div class="user-default-reset-password">

    <div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <p><?= UserModule::t('module', 'Please choose your new password') ?>:</p>

                <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton(UserModule::t('module', 'Save'), ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    </div>

</div>