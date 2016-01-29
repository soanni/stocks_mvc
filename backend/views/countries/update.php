<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\country\Country */

$this->title = 'Update Country: ' . ' ' . $model->countryid;
$this->params['breadcrumbs'][] = ['label' => 'Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->countryid, 'url' => ['view', 'id' => $model->countryid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="country-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
