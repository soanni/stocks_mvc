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
            [
                'attribute' => 'country.countryname',
                'filter' => Html::activeDropDownList($searchModel,'countryid',DatabaseHelper::getCountriesList(),['prompt' => 'Select country'])
            ],
            'indname',
            'isin',
            'ActiveFlag',
            // 'ChangeDate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
