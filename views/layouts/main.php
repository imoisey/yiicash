<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\modules\user\Module as UserModule;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    if (Yii::$app->user->isGuest) {
        $navItems = [
            ['label' => UserModule::t('module', 'Login'), 'url' => ['/user/default/login']]
        ];
    } else {
        $navItems = [
            ['label' => Yii::t('app', 'Home'), 'url' => ['/main/events/index']],
            ['label' => Yii::t('app', 'Report'), 'url' => ['/main/reports/index']],
            ['label' => UserModule::t('module', 'Users'), 'url' => ['/user/users/index']],
            [
                'label' => Yii::$app->user->identity->getFullName(),
                'items' => [
                    [
                        'label' => UserModule::t('module', 'Profile'),
                        'url' => ['/user/profile/index'],
                    ],
                    '<li class="divider"></li>',
                    [
                        'label' => UserModule::t('module', 'Logout'),
                        'url' => ['/user/default/logout'],
                        'linkOptions' => [
                            'data-method' => 'post',
                        ]
                    ]
                ]
            ]
        ];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => $navItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer navbar-fixed-bottom">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->name ?> </p>

        <p class="pull-right"><?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
