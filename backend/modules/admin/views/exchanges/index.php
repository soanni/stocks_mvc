<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\helpers\DatabaseHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\exchange\ExchangeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exchanges';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exchange-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Exchange', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'exchname',
            [
                'attribute' => 'country.countryname',
                'filter' => Html::activeDropDownList($searchModel,'countryid',DatabaseHelper::getCountriesList(),['prompt' => 'Select country'])
            ],
            [
                'attribute' => 'web',
                'format' => 'url'
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
