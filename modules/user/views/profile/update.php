<?php
 
use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
 
/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */
 
$this->title = Yii::t('app', 'Editing');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profile'), 'url' => 'index'];
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
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
 
</div>