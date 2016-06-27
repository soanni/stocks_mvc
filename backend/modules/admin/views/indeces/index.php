<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\helpers\DatabaseHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\index\IndexSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Indeces';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="index-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Index', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'exchange.country.countryname',

            [
                'attribute' => 'exchange.exchname',
                'filter' => Html::activeDropDownList($searchModel,'exchangeid',DatabaseHelper::getExchangesList(),['prompt' => 'Select exchange'])
            ],
            'indname',
            'isin',
            'ActiveFlag',
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
            ],
        ],
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
