<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $rate->quote->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Charts', 'url' => ['search']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(Yii::getAlias('@web/js/candlestick.js'), ['depends' => ['yii\web\YiiAsset', 'yii\bootstrap\BootstrapAsset'],]);

?>
<div id = <?= $rate->quoteid;?> class="chart-view">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center">Trading information</h3>
        </div>
        <div class="col-md-12">
            <h4 class="text-center">
                <?php
                if($rate->quote->privileged){
                    $priv = ', privileged share ';
                }else{
                    $priv = ', ordinary share ';
                }
                $text = $rate->quote->company->companyname . $priv . '(' . $rate->quote->acronym . ')';
                echo $text;
                ?>
            </h4>
        </div>
        <div class="col-md-12">

            <ul class="list-inline">
                <li>
                    <span style="font-weight: bold;font-size: large;">
                        <?= Yii::$app->formatter->asDecimal($rate->lastdeal);?>
                    </span>
                    <?php $diff = $rate->getDiffFromTheDayBefore();?>
                    <span <?php if($diff < 0){echo 'style="color:red"';}else{echo 'style="color:green"';}?>>
                        <?= $diff?>
                    </span>
                </li>
                <li>Maximum:&nbsp<span><?= Yii::$app->formatter->asDecimal($rate->maximum);?></span></li>
                <li>Open rate:&nbsp<span><?= Yii::$app->formatter->asDecimal($rate->openrate);?></span></li>
                <li>Number of deals (today):&nbsp<span><?= Yii::$app->formatter->asInteger($rate->deals);?></span></li>
            </ul>
            <ul class="list-inline">
                <li>Minimum:&nbsp<span><?= Yii::$app->formatter->asDecimal($rate->minimum);?></span></li>
                <li>Close rate:&nbsp<span><?= Yii::$app->formatter->asDecimal($rate->closerate);?></span></li>inimum
                <li>Volume:&nbsp<span><?= Yii::$app->formatter->asInteger($rate->dayvol);?></span></li>
                <li>Last deal:&nbsp<span><?= Yii::$app->formatter->asDecimal($rate->lastdeal);?></span></li>
            </ul>
        </div>
        <div class="col-md-12">
            <hr/>
            <div id="chart"></div>
        </div>
    </div>
</div>
