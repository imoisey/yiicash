<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
use yii\helpers\Html;
use app\modules\user\Module as UserModule;
use yii\bootstrap\ActiveForm;

$this->title = UserModule::t('module', 'Login');
?>
<div class="user-default-login">

    <div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <p><?= UserModule::t('module', 'Please fill out the following fields to login')?>:</p>

                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                            <?= $form->field($model, 'password')->passwordInput() ?>

                            <?= $form->field($model, 'rememberMe')->checkbox() ?>

                            <div class="form-group">
                                <?= Html::submitButton(UserModule::t('module', 'Login'), ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                            </div>

                            <div class="text-center">
                            <?= Html::a(UserModule::t('module', 'Forgot password?'), ['/user/default/password-reset-request']) ?>.
                            </div>

                        <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    </div>

    
</div>
