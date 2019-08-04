<?php
 
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\user\Module as UserModule;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */
 
$this->title = UserModule::t('module','Profile');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile">
 
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(UserModule::t('module','Edit'), ['update'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(UserModule::t('module','Change Password'), ['password-change'], ['class' => 'btn btn-primary']) ?>
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