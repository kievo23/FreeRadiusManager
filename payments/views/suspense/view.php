<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Suspense */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Suspenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="suspense-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'mpesa_id',
            'original',
            'destination',
            'customer_id',
            'test:ntext',
            'mpesa_code',
            'mpesa_acc',
            'mpesa_msidn',
            'mpesa_amount',
            'mpesa_sender',
            'status',
            'actual_uri',
            'timestamp',
        ],
    ]) ?>

</div>
