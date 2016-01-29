<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\order\Order */

$this->title = $model->orid;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->orid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->orid], [
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
            'orid',
            'ordate',
            'ortype',
            'brokerid',
            'exchid',
            'companyid',
            'qid',
            'amount',
            'currencyid',
            'price',
            'stoploss',
            'stopprice',
            'takeprofit',
            'takeprice',
            'amountlot',
            'total',
            'brokerrevenue',
            'orcomment',
            'parentid',
            'changedate',
            'ActiveFlag',
            'accountid',
        ],
    ]) ?>

</div>
