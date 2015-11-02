<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Radcheck */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="radcheck-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'attribute')->dropDownList(['Cleartext-Password'=>'Cleartext-Password'],['prompt'=>'--Attribute--']) ?>

    <?= $form->field($model, 'op')->dropDownList([':='=>':=','=='=>'=='],['prompt'=>'--Operation--']) ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
