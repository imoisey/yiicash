<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Login');
?>
<div class="user-default-login">

    <div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <p><?= Yii::t('app', 'Please fill out the following fields to login')?>:</p>

                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                            <?= $form->field($model, 'password')->passwordInput() ?>

                            <?= $form->field($model, 'rememberMe')->checkbox() ?>

                            <div class="form-group">
                                <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                            </div>

                            <div class="text-center">
                            <?= Html::a(Yii::t('app', 'Forgot password?'), ['/user/default/password-reset-request']) ?>.
                            </div>

                        <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    </div>

    
</div>
