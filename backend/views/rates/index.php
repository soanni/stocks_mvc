<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\rates\RateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rate-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rate', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'quote.acronym',
            'openrate',
            'closerate',
            'ratedate',
            'minimum',
            'maximum',
            'lastdeal',
            'deals',
            'wa',
            'dayval',
            'dayvol',
            // 'ActiveFlag',
            // 'ChangeDate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
