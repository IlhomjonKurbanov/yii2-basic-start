<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;
use modules\user\Module;

/* @var $this yii\web\View */
/* @var $model modules\user\models\User */

$this->title = Module::t('module', 'Profile');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="users-frontend-profile-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="nav-tabs">
        <?= Tabs::widget([
            'options' => ['role' => 'tablist'],
            'items' => [
                [
                    'label' => Html::encode($this->title),
                    'content' => $this->render('tabs/_view', [
                        'model' => $model
                    ]),
                    'options' => ['id' => 'profile', 'role' => 'tabpanel'],
                    'active' => (!Yii::$app->request->get('tab') || (Yii::$app->request->get('tab') == 'profile')) ? true : false,
                ],
            ]
        ]); ?>
    </div>
</div>