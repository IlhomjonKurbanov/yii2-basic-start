<?php

/**
 * @var $this \yii\web\View
 * @var $content string
 */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use modules\main\Module as MainModule;
use modules\users\Module as UserModule;
use modules\admin\Module as AdminModule;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Yii::$app->name . ' | ' . Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/images/logo.png', ['alt' => Yii::$app->name, 'class' => 'yii-logo']) . Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        [
            'label' => MainModule::t('module', 'Home'),
            'url' => ['/main/default/index']
        ],
        [
            'label' => MainModule::t('module', 'About'),
            'url' => ['/main/default/about']
        ],
        [
            'label' => MainModule::t('module', 'Contact'),
            'url' => ['/main/default/contact']
        ],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => UserModule::t('module', 'Check in'), 'url' => ['/users/default/signup']];
        $menuItems[] = [
            'label' => UserModule::t('module', 'Login'),
            'url' => ['/users/default/login']
        ];
    } else {
        /** @var modules\users\models\User $identity */
        $identity = Yii::$app->user->identity;
        $menuItems[] = [
            'label' => UserModule::t('module', 'My Menu'),
            'items' => [
                [
                    'label' => '<i class="glyphicon glyphicon-queen"></i> ' . AdminModule::t('module', 'Administration'),
                    'url' => ['/admin/default/index'],
                    'visible' => Yii::$app->user->can(\modules\rbac\models\Permission::PERMISSION_VIEW_ADMIN_PAGE),
                ],
                [
                    'label' => '<i class="glyphicon glyphicon-lock"></i> ' . AdminModule::t('rbac', 'RBAC'),
                    'url' => ['/rbac/default/index'],
                    'visible' => Yii::$app->user->can(\modules\rbac\models\Permission::PERMISSION_MANAGER_RBAC),
                ],
                [
                    'label' => '<i class="glyphicon glyphicon-eye-open"></i> ' . UserModule::t('module', 'Profile') . ' (' . $identity->username . ')',
                    'url' => ['/users/profile/index'],
                ],
                [
                    'label' => '<i class="glyphicon glyphicon-log-out"></i> ' . UserModule::t('module', 'Sign Out'),
                    'url' => ['/users/default/logout'],
                    'linkOptions' => [
                        'data-method' => 'post'
                    ]
                ],
            ],
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'activateParents' => true,
        'encodeLabels' => false,
        'items' => array_filter($menuItems)
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

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->name . ' ' . date('Y') ?></p>

        <p class="pull-right">Powered by <a href="http://www.yiiframework.com/" target="_blank">Yii Framework</a></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
