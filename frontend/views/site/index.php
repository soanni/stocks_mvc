<?php

/* @var $this yii\web\View */
use yii\bootstrap\Tabs;
use yii\bootstrap\Nav;
use yii\helpers\Html;

$this->title = 'Stocks app';
$this->registerJsFile(Yii::getAlias('@web/js/button-period.js'), ['depends' => ['yii\web\YiiAsset', 'yii\bootstrap\BootstrapAsset'],]);
?>
<div class="row">
    <div class="col-md-3">
        <?= Nav::widget([
        'options' => ['class' => 'nav nav-pills nav-stacked'],
        'items' => [['label' => 'Candlesticks charts'],['label' => 'Breaking news'],['label' => 'Securities']],
        ]); ?>
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-sm-6">
                <?= \frontend\components\CarouselWidget\CarouselWidget::widget([
                    'models' => $models,
                    'options' => ['style' => 'border:1px solid black;text-align:center;padding:5px;']
                ]);?>
                <h2>Breaking news</h2>
                <hr/>
                <p>
                    Islamic State have moved to Libya from Iraq and Syria in recent months, according to a top Libyan intelligence official.
                    The official told BBC Newsnight that increasing numbers of foreign fighters had arrived in the city of Sirte.
                    Representatives from 23 countries, including the US and UK, met in Rome on Tuesday to discuss the growing threat from Islamic State (IS) in Libya.
                    IS took control of Sirte last year.
                    Disagreements between rival administrations in the country have hampered efforts to fight IS.
                </p>
                <h3>Leaders and outsiders</h3>
                <div class="row">
                    <div class="col-sm-12">
                        <button id='button-day' type='button' class="btn btn-default btn-xs active">Day</button>
                        <button id='button-month' type='button' class="btn btn-default btn-xs">Month</button>
                        <button id='button-year' type='button' class="btn btn-default btn-xs">Year</button>
                        <button id='button-all' type='button' class="btn btn-default btn-xs">All</button>
                        <p></p>
                    </div>
                    <div id = 'div-leaders' class="col-sm-6">
                        <table id = 'table-leaders' class = 'table table-condensed table-striped table-responsive'>
                            <?php foreach($leaders as $leader): ?>
                            <?php $url = 'charts/view?id=' . $leader['qid'];?>
                            <tr>
                                <td><?= Html::a($leader['shortname'],[$url])?>
                                <td><?= $leader['diff'].'%';?></td>
                            </tr>
                            <?php endforeach;?>
                        </table>
                    </div>
                    <div id = 'div-loosers' class="col-sm-6">
                        <table id = 'table-loosers' class = 'table table-condensed table-striped table-responsive'>
                            <?php foreach($loosers as $looser): ?>
                                <?php $url = 'charts/view?id=' . $looser['qid'];?>
                                <tr>
                                    <td><?= Html::a($looser['shortname'],[$url])?>
                                    <td><?= $looser['diff'].'%';?></td>
                                </tr>
                            <?php endforeach;?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <?= \frontend\components\TabsWidget\TabsWidget::widget([
                    'models' => $models
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
