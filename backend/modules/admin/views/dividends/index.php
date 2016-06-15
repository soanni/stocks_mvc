<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\helpers\DatabaseHelper;
use common\helpers\LimitedWidthColumn;

/* @var $this yii\web\View */
/* @var $searchModel common\models\dividend\DividendSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dividend calendar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="index-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create dividend', ['create'], ['class' => 'btn btn-success actionModal']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
            ],
//            [
//                'class' => LimitedWidthColumn::className(),
//                'attribute' => 'exchange.country.countryname'
//            ],
//            [
//                'class' => LimitedWidthColumn::className(),
//                'attribute' => 'exchange.exchname',
//                'filter' => Html::activeDropDownList($searchModel,'exchid',DatabaseHelper::getExchangesList(),['prompt' => 'Select exchange','style'=>'max-width:90px;font-size:10px'])
//            ],
            [
                'class' => LimitedWidthColumn::className(),
                'attribute' => 'company.companyname',
                //'filter' => Html::activeDropDownList($searchModel,'companyid',DatabaseHelper::getCountriesList(),['prompt' => 'Select country','style'=>'max-width:90px;font-size:10px'])
            ],
            [
                'class' => LimitedWidthColumn::className(),
                'attribute' => 'quote.fullname',
                //'filter' => Html::activeDropDownList($searchModel,'quoteid',DatabaseHelper::getQuotesFullnameList(),['prompt' => 'Select share','style'=>'max-width:90px;font-size:10px'])
            ],
//            [
//                'class' => LimitedWidthColumn::className(),
//                'attribute' => 'currency.curname',
//                'filter' => Html::activeDropDownList($searchModel,'currencyid', DatabaseHelper::getCurrenciesList(),['prompt' => 'Select currency','style'=>'max-width:90px;font-size:10px'])
//            ],
            [
                'class' => LimitedWidthColumn::className(),
                'attribute' => 'exdividenddate'
            ],
            [
                'class' => LimitedWidthColumn::className(),
                'attribute'=> 'recorddate'
            ],
            [
                'class' => LimitedWidthColumn::className(),
                'attribute' => 'announcementdate'
            ],
            [
                'class' => LimitedWidthColumn::className(),
                'attribute' => 'paymentdate'
            ],
            [
                'class' => LimitedWidthColumn::className(),
               'attribute' => 'value'
            ],
//            [
//                'class' => LimitedWidthColumn::className(),
//                'attribute' => 'ActiveFlag'
//            ],
            [
                'class' => \yii\grid\ActionColumn::className(),
                'header' => 'Actions',
                'buttons' => [
                    'view' => function($url, $model, $key){
                        $options =[
                            'title' => Yii::t('yii', 'View'),
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                            'class' => 'actionModal'
                        ];
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                    }
                ]
            ]
        ]
    ]); ?>

    <?php
        \yii\bootstrap\Modal::begin([
            'headerOptions' => ['id' => 'modal-header'],
            'id' => 'modal',
            'options' => ['class' => 'slide'],
            'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
        ]);
        echo "<div id='modal-body'></div>";
        \yii\bootstrap\Modal::end();
    ?>


</div>
