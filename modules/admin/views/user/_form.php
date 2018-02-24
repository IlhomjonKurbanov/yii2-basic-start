<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use modules\admin\Module;

/* @var $this yii\web\View */
/* @var $model modules\admin\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput([
        'maxlength' => true,
        'placeholder' => true,
    ]) ?>

    <?= $form->field($model, 'email')->textInput([
        'maxlength' => true,
        'placeholder' => true,
    ]) ?>

    <?= $form->field($model, 'password')->passwordInput([
        'maxlength' => true,
        'placeholder' => true,
    ]) ?>

    <?= $form->field($model, 'first_name')->textInput([
        'maxlength' => true,
        'placeholder' => true,
    ]) ?>

    <?= $form->field($model, 'last_name')->textInput([
        'maxlength' => true,
        'placeholder' => true,
    ]) ?>

    <?= $form->field($model, 'status')->dropDownList($model->statusesArray, [
        'class' => 'form-control',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-save"></span> ' . Module::t('users', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
