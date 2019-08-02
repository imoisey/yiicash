<?php
 
use yii\helpers\Html;
use yii\widgets\DetailView;
 
/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */
 
$this->title = Yii::t('app', 'Profile');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile">
 
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Edit'), ['update'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Change Password'), ['password-change'], ['class' => 'btn btn-primary']) ?>
    </p>
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'statusname',
            'fullname',
            'username',
            'email',
        ],
    ]) ?>
 
</div>