<?php

/**
 * @var $this yii\web\View
 * @var $model modules\user\models\User
 */

use yii\bootstrap\Tabs;
use modules\user\Module;

$this->title = Module::t('module', 'Update');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'Profile'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile-update">
    <div class="nav-tabs">
        <?= Tabs::widget([
            'options' => ['role' => 'tablist'],
            'items' => [
                [
                    'label' => Module::t('module', 'Profile'),
                    'content' => $this->render('tabs/_update_profile', [
                        'model' => $model,
                    ]),
                    'options' => ['id' => 'profile', 'role' => 'tabpanel'],
                    'active' => (!Yii::$app->request->get('tab') || (Yii::$app->request->get('tab') == 'profile')) ? true : false,
                ],
                [
                    'label' => Module::t('module', 'Password'),
                    'content' => $this->render('tabs/_update_password', [
                        'model' => $model,
                    ]),
                    'options' => ['id' => 'password', 'role' => 'tabpanel'],
                    'active' => (Yii::$app->request->get('tab') == 'password') ? true : false,
                ],
                [
                    'label' => Module::t('module', 'Avatar'),
                    'content' => $this->render('tabs/_update_avatar', [
                        'model' => $model,
                    ]),
                    'options' => ['id' => 'avatar', 'role' => 'tabpanel'],
                    'active' => (Yii::$app->request->get('tab') == 'avatar') ? true : false,
                ],
            ]
        ]); ?>
    </div>
</div>
