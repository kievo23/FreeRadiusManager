<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Suspenses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="suspense-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'mpesa_id',
            'original',
            'destination',
            'customer_id',
            // 'test:ntext',
             'mpesa_code',
             'mpesa_acc',
             'mpesa_msidn',
             'mpesa_amount',
             'mpesa_sender',
             'status',
            // 'actual_uri',
             'timestamp',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
