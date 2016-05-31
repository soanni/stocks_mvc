<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\order\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'orid',
            'ordate',
            'ortype',
            'brokerid',
            'exchid',
            // 'companyid',
            // 'qid',
            // 'amount',
            // 'currencyid',
            // 'price',
            // 'stoploss',
            // 'stopprice',
            // 'takeprofit',
            // 'takeprice',
            // 'amountlot',
            // 'total',
            // 'brokerrevenue',
            // 'orcomment',
            // 'parentid',
            // 'changedate',
            // 'ActiveFlag',
            // 'accountid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
