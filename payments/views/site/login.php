<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .background{
    }
    .background:after{
        content:'';
        background:url('../../images/background5.jpg') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        width:100%;
        height:100%;
        position:absolute;
        top:0;
        left:0;
        bottom: 0;
        opacity:0.9;
    }
    .site-index{
        padding-top: 2%;
        position:relative;
        z-index:1;
    }
    .bit{
        background-color: #fff;
        padding: 10px;
        border-radius: 10px;
    }
</style>
    

<div class="background">

    <div class="site-index">

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 bit" style="text-align:center">
            <div class="col-md-1"></div>
            <div class="col-md-10 bit" style="text-align:center">
                <p style="text-align:center">
                        <img src="../../images/fon_logo.png">
                    </p><hr>
                   
                    

                <?php 

                $form = ActiveForm::begin([
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
            <div class="col-md-1"></div>
        </div>
        <div class="col-md-3"></div>

    </div>

    <div class="col-lg-offset-1" style="color:#999;">
        
    </div>
    </div>

</div>