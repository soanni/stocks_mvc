<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\helpers\DatabaseHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\company\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Company', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => function($model, $key, $index, $grid){
            if(!$model->ActiveFlag){
                return ['class' => 'danger'];
            }else
                return [];
        },
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'companyname',
            [
                'attribute' => 'web',
                'format' => 'url'
            ],
            [
                'attribute' => 'country.countryname',
                'filter' => Html::activeDropDownList($searchModel,'countryid',DatabaseHelper::getCountriesList(),['prompt' => 'Select country'])
            ],
            [
                'attribute' => 'ActiveFlag',
                'format' => 'boolean',
                'filter' => ''
                //'filter' => Html::activeCheckbox($searchModel,'ActiveFlag')
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {restore}',
                'buttons' => [
                    'delete' => function ($url, $model, $key) {
                        $options = [
                            'title' => Yii::t('yii', 'Delete'),
                            'aria-label' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            'data-method' => 'post',
                            'data-pjax' => '0'
                        ];
                        return ($model->ActiveFlag) ? Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, $options): '';
                    },
                    'restore' => function($url, $model, $key){
                        $options = [
                            'title' => Yii::t('yii', 'Restore'),
                            'aria-label' => Yii::t('yii', 'Restore'),
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to restore this item?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ];
                        return !($model->ActiveFlag) ? Html::a('<span class="glyphicon glyphicon-ok"></span>', $url,$options) : '';
                    }
                ]
            ],
        ],
    ]); ?>

</div>
