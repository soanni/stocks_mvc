<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\helpers\DatabaseHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\quote\QuoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quotes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quote-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Quote', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'fullname',
            //'shortname',
            'englishname',
            'acronym',
            [
                'attribute' => 'exch.exchname',
                'filter' => Html::activeDropDownList($searchModel,'exchid',DatabaseHelper::getExchangesList(),['prompt' => 'Select exchange'])
            ],
            [
                'attribute' => 'company.companyname',
                //'filter' => Html::activeDropDownList($searchModel,'companyid',DatabaseHelper::getCompaniesList(),['prompt' => 'Select company'])
            ],
            [
                'label' => 'Indeces',
                'content' => function ($model, $key, $index, $column) {
                    $value = '';
                    foreach($model->indeces as $index){
                        $value .= '[' . $index->indname .']';
                    }
                    return $value;
                }
            ],
            [
                'attribute' => 'privileged',
                'format' => 'boolean'
            ],
            'ActiveFlag',
            // 'ChangeDate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
