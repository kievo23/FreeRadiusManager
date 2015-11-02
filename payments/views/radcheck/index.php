<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Radreply;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Radchecks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="radcheck-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Radcheck', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
                'username',
                'attribute',
                'op',
                [
                    'attribute'=> 'Radcheck.value',
                    'value' => 'value',
                ],
                'reply',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
