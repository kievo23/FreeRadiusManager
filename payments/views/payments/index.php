<?php

use yii\helpers\Html;
use yii\grid\GridView;
use Yii;
use \yii\web\IdentityInterface;
use app\models\Radiususers;
/* @var $this yii\web\View */
/* @var $searchModel app\search\PaymentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payments';
$this->params['breadcrumbs'][] = $this->title;

if(!Yii::$app->user->isGuest){
    $user = Radiususers::findOne(['id' => Yii::$app->user->id]);
}


?>
<div class="payments-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Payments', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'mpesa_id',
            'original',
            //'destination',
            //'customer_id',
            // 'test:ntext',
             'mpesa_code',
             'mpesa_acc',
             'mpesa_msidn',
             'mpesa_amount',
             'mpesa_sender',
             'timestamp',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
