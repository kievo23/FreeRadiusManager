<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Radacct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="radacct-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'acctsessionid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'acctuniqueid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'groupname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'realm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nasipaddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nasportid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nasporttype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'acctstarttime')->textInput() ?>

    <?= $form->field($model, 'acctstoptime')->textInput() ?>

    <?= $form->field($model, 'acctsessiontime')->textInput() ?>

    <?= $form->field($model, 'acctauthentic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'connectinfo_start')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'connectinfo_stop')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'acctinputoctets')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'acctoutputoctets')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'calledstationid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'callingstationid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'acctterminatecause')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'servicetype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'framedprotocol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'framedipaddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'acctstartdelay')->textInput() ?>

    <?= $form->field($model, 'acctstopdelay')->textInput() ?>

    <?= $form->field($model, 'xascendsessionsvrkey')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
