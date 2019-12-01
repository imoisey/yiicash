<?php
use yii\helpers\Html;
use app\modules\user\Module as UserModule;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['user/default/password-reset', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p><?= Yii::t('app', 'Hello, {username}', ['username' => Html::encode($user->username)]) ?>.</p>

    <p><?= UserModule::t('module', 'Follow the link below to reset your password') ?>:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>