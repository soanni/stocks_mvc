<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model common\models\index\Index */

$this->title = $model->indname;
$this->params['breadcrumbs'][] = ['label' => 'Indices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="index-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->indexid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->indexid], [
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
            'indexid',
            'countryid',
            'indname',
            'isin',
            'ActiveFlag',
            'ChangeDate',
        ],
    ]) ?>

    <h2>Quotes belonging to index</h2>
    <hr>

    <?= \yii\grid\GridView::widget([
        'dataProvider' =>$dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'fullname',
            'acronym',
            [
                'attribute' => 'privileged',
                'format' => 'boolean'
            ]
        ]
    ]);?>

</div>
