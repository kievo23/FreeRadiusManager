<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Radiususers */

$this->title = 'Create Radiususers';
$this->params['breadcrumbs'][] = ['label' => 'Radiususers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="radiususers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
