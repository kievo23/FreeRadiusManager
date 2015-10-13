<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\search\MpesaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mpesas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mpesa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mpesa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'origin',
            'destination',
            'customer_id',
            'user',
            // 'pass',
            // 'routemethod_id',
            // 'routemethod_name',
            // 'business_number',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
