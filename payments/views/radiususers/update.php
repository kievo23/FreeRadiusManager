<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Radiususers */

$this->title = 'Update Radiususers: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Radiususers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="radiususers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_update', [
        'model' => $model,
    ]) ?>

</div>
