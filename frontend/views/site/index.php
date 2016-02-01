<?php

/* @var $this yii\web\View */
use yii\bootstrap\Tabs;

$this->title = 'Stocks app';
?>
<div class="row">
    <div class="col-md-12">
        <?= \frontend\components\CarouselWidget\CarouselWidget::widget([
            'models' => $models,
            'options' => ['style' => 'border:1px solid black;text-align:center;padding:5px;']
        ]);?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <p>
            Hello
        </p>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?= \frontend\components\TabsWidget\TabsWidget::widget([
            'models' => $models
        ]);
        ?>
    </div>
    <div class="col-md-6"></div>
</div>
