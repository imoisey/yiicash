<?php

use app\modules\user\Module as UserModule;

/* @var $this yii\web\View */
/* @var $user common\models\User */
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['user/default/reset-password', 'token' => $user->password_reset_token]);
?>
<?= Yii::t('app', 'Hello, {username}', ['username' => $user->username]) ?>,

<?= UserModule::t('module', 'Follow the link below to reset your password') ?>:

<?= $resetLink ?>