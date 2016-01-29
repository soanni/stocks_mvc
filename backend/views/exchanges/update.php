<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\exchange\Exchange */

$this->title = 'Update Exchange: ' . ' ' . $model->exchid;
$this->params['breadcrumbs'][] = ['label' => 'Exchanges', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->exchid, 'url' => ['view', 'id' => $model->exchid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="exchange-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
