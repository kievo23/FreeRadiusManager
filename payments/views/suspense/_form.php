<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Suspense */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="suspense-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mpesa_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'original')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'destination')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'test')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'mpesa_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mpesa_acc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mpesa_msidn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mpesa_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mpesa_sender')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(['yes'=>'Yes','no'=>'No'],['prompt'=>'Have you Editted?']) ?>

    <?= $form->field($model, 'actual_uri')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'timestamp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
