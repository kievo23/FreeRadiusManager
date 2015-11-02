<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Radacct */

$this->title = 'Update Radacct: ' . ' ' . $model->radacctid;
$this->params['breadcrumbs'][] = ['label' => 'Radaccts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->radacctid, 'url' => ['view', 'id' => $model->radacctid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="radacct-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
