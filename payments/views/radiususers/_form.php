<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Radiususers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="radiususers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'departments')->dropDownList(['Soliton'=>'Soliton','FON'=>'FON'],['prompt'=>'Department?']) ?>

    <?= $form->field($model, 'roles')->dropDownList(['1'=>'Admin','2'=>'Technical','3'=>'Accounts'],['prompt'=>'Role?']) ?>

    <?= $form->field($model, 'status')->dropDownList(['1'=>'Yes','0'=>'No'],['prompt'=>'User Active?']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
