<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Suspense */

$this->title = 'Create Suspense';
$this->params['breadcrumbs'][] = ['label' => 'Suspenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="suspense-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
