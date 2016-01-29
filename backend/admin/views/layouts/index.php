<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $generators \yii\gii\Generator[] */
/* @var $activeGenerator \yii\gii\Generator */
/* @var $content string */

$controllers =

];
?>
<?php $this->beginContent('@backend/views/layouts/main.php'); ?>
<div class="row">
    <div class="col-md-3 col-sm-4">
        <div class="list-group">
            <?php
            foreach ($controllers as $controller) {
                $label = '<i class="glyphicon glyphicon-chevron-right"></i>' . Html::encode($controller['name']);
                echo Html::a($label, $controller['link'], ['class' =>'list-group-item']);
            }
            ?>
        </div>
    </div>
    <div class="col-md-9 col-sm-8">
        <?= $content ?>
    </div>
</div>
<?php $this->endContent(); ?>
