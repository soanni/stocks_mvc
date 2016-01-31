<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\index\Index */

$this->title = 'Update Index: ' . ' ' . $model->indname;
$this->params['breadcrumbs'][] = ['label' => 'Indices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->indexid, 'url' => ['view', 'id' => $model->indexid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="index-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
