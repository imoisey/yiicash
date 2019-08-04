<?php
 
use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\user\Module as UserModule;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */
 
$this->title = UserModule::t('module','Editing');
$this->params['breadcrumbs'][] = ['label' => UserModule::t('module','Profile'), 'url' => 'index'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile">
 
    <h1><?= Html::encode($this->title) ?></h1>
 
    <?php $form = ActiveForm::begin([]); ?>

    <?= $form->field($model, 'firstname')->input('firstname', ['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname')->input('lastname', ['maxlength' => true]) ?>
 
    <?= $form->field($model, 'username')->input('username', ['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->input('email', ['maxlength' => true]) ?>
    
    <div class="form-group">
        <?= Html::submitButton(UserModule::t('module','Save'), ['class' => 'btn btn-primary']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
 
</div>