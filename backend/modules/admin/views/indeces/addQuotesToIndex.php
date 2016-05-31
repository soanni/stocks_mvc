<?php
    use yii\grid\GridView;
    use yii\helpers\Html;
    use common\helpers\DatabaseHelper;

    //$this->registerCss('.table > tbody > tr:hover{ background-color : #89ae37; }');
?>

<?= GridView::widget([
    'id' => 'grid-add-quote-to-index',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    //'rowOptions' => ['onclick' => 'indexAddToQuoteRowOnClick()'],
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
