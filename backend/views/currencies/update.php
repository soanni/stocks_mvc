<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\currency\Currency */

$this->title = 'Update Currency: ' . ' ' . $model->curid;
$this->params['breadcrumbs'][] = ['label' => 'Currencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->curid, 'url' => ['view', 'id' => $model->curid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="currency-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
