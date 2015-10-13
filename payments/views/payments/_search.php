<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\search\PaymentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payments-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'mpesa_id') ?>

    <?= $form->field($model, 'original') ?>

    <?= $form->field($model, 'destination') ?>

    <?= $form->field($model, 'customer_id') ?>

    <?php // echo $form->field($model, 'test') ?>

    <?php // echo $form->field($model, 'mpesa_code') ?>

    <?php // echo $form->field($model, 'mpesa_acc') ?>

    <?php // echo $form->field($model, 'mpesa_msidn') ?>

    <?php // echo $form->field($model, 'mpesa_amount') ?>

    <?php // echo $form->field($model, 'mpesa_sender') ?>

    <?php // echo $form->field($model, 'timestamp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
