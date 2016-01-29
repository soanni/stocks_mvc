<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\order\Order */

$this->title = 'Update Order: ' . ' ' . $model->orid;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->orid, 'url' => ['view', 'id' => $model->orid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
