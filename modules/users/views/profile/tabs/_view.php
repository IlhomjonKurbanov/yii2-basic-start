<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use modules\users\widgets\AvatarWidget;
use modules\users\Module;

/**
 * @var $this yii\web\View
 * @var $model modules\users\models\User
 */

$this->registerJs(new yii\web\JsExpression("
    $(function () {
        $('[data-toggle=\"tooltip\"]').tooltip();        
    });
"), yii\web\View::POS_END);
?>

<div class="row">
    <div class="col-sm-2">
        <?= AvatarWidget::widget() ?>
    </div>
    <div class="col-sm-10">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'username',
                'first_name',
                'last_name',
                'email:email',
                [
                    'attribute' => 'role',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->role;
                    },
                ],
                [
                    'attribute' => 'status',
                    'format' => 'raw',
                    'value' => $model->statusLabelName,
                ],
                [
                    'attribute' => 'auth_key',
                    'format' => 'raw',
                    'value' => function ($model) {
                        $key = Html::tag('code', $model->auth_key, ['id' => 'authKey']);
                        $link = Html::a(Module::t('module', 'Generate'), ['/profile/generate-auth-key'], [
                            'class' => 'btn btn-sm btn-default',
                            'title' => Module::t('module', 'Generate new key'),
                            'data' => [
                                'toggle' => 'tooltip',
                            ],
                            'onclick' => "                                
                                $.ajax({
                                    type: 'POST',
                                    cache: false,
                                    url: this.href,
                                    success: function(response) {                                       
                                        if(response.success) {
                                            $('#authKey').html(response.success);
                                        }
                                    }
                                });
                                return false;
                            ",
                        ]);
                        return $key . ' ' . $link;
                    }
                ],
                'created_at:datetime',
                'updated_at:datetime',
                'last_visit:datetime',
            ],
        ]) ?>
    </div>
    <div class="col-sm-offset-2 col-sm-10">
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> ' . Module::t('module', 'Update'), ['update'], [
            'class' => 'btn btn-primary'
        ]) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> ' . Module::t('module', 'Delete'), ['delete'], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Module::t('module', 'Are you sure you want to delete the record?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>
</div>
