<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Suspense */
if(isset($result)){
	echo "<pre>";
	print_r($result);
	echo "</pre>";
}

$this->title = 'Update Suspense: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Suspenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="suspense-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
