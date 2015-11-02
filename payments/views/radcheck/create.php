<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Radcheck */

$this->title = 'Create Radcheck';
$this->params['breadcrumbs'][] = ['label' => 'Radchecks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="radcheck-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
