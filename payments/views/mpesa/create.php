<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Mpesa */

$this->title = 'Create Mpesa';
$this->params['breadcrumbs'][] = ['label' => 'Mpesas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mpesa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
