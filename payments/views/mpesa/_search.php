<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\search\MpesaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mpesa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'origin') ?>

    <?= $form->field($model, 'destination') ?>

    <?= $form->field($model, 'customer_id') ?>

    <?= $form->field($model, 'user') ?>

    <?php // echo $form->field($model, 'pass') ?>

    <?php // echo $form->field($model, 'routemethod_id') ?>

    <?php // echo $form->field($model, 'routemethod_name') ?>

    <?php // echo $form->field($model, 'business_number') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
