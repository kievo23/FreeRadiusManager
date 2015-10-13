<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
        <p style="text-align:center">
                <img src="../../images/fon_logo.png">
            </p><hr>
            <pre style="text-align:center">Automatic Connection and Disconnection of Retail Clients</pre>
            

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => "<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-4\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],
        ]); ?>

            <?= $form->field($model, 'username')->textInput(['class' => 'form-control','placeholder'=>'USERNAME']) ?>

            <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control','placeholder'=>'*******************']) ?>

            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ]) ?>

            <div class="form-group ">
                <div class="col-lg-offset-1 col-lg-10">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary form-control', 'name' => 'login-button']) ?>
                </div>
            </div>

        <?php ActiveForm::end(); ?>
        </div>
        <div class="col-md-2"></div>

    </div>

    <div class="col-lg-offset-1" style="color:#999;">
        
    </div>
</div>
