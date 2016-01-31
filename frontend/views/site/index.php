<?php

/* @var $this yii\web\View */
use yii\bootstrap\Tabs;

$this->title = 'Stocks app';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <?= \frontend\components\CarouselWidget\CarouselWidget::widget([
                'models' => $models,
                'options' => ['style' => 'border:1px solid black;text-align:center;padding:5px;']
            ]);?>
        </div>
        <div class="row">
            <div class="col-lg-8">

            </div>
            <div class="col-lg-4">
                <?= \frontend\components\TabsWidget\TabsWidget::widget([
                    'models' => $models
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
