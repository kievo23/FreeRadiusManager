<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Radaccts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="radacct-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Radacct', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'radacctid',
            'acctsessionid',
            'acctuniqueid',
            'username',
            'groupname',
            // 'realm',
            // 'nasipaddress',
            // 'nasportid',
            // 'nasporttype',
            // 'acctstarttime',
            // 'acctstoptime',
            // 'acctsessiontime:datetime',
            // 'acctauthentic',
            // 'connectinfo_start',
            // 'connectinfo_stop',
            // 'acctinputoctets',
            // 'acctoutputoctets',
            // 'calledstationid',
            // 'callingstationid',
            // 'acctterminatecause',
            // 'servicetype',
            // 'framedprotocol',
            // 'framedipaddress',
            // 'acctstartdelay',
            // 'acctstopdelay',
            // 'xascendsessionsvrkey',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
