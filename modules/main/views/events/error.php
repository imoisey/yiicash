<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use app\modules\main\Module as MainModule;

$this->title = $name;
?>
<div class="main-default-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        <?= MainModule::t('module', 'The above error occurred while the Web server was processing your request') ?>.
    </p>
    <p>
        <?= MainModule::t('module', 'Please contact us if you think this is a server error. Thank you.') ?>
    </p>

</div>
