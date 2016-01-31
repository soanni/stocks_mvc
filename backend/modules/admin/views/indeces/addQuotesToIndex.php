<?php
    use yii\grid\GridView;
    use yii\helpers\Html;
    use common\helpers\DatabaseHelper;
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'fullname',
        'acronym',
//        [
//            'attribute' => 'exch.exchname',
//            'filter' => Html::activeDropDownList($searchModel,'exchid',DatabaseHelper::getExchangesList(),['prompt' => 'Select exchange'])
//        ],
//        [
//            'label' => 'Indeces',
//            'content' => function ($model, $key, $index, $column) {
//                $value = '';
//                foreach($model->indeces as $index){
//                    $value .= '[' . $index->indname .']';
//                }
//                return $value;
//            }
//        ],
        [
            'attribute' => 'privileged',
            'format' => 'boolean'
        ],
    ],
]); ?>
