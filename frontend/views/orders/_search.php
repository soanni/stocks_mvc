<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\order\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'orid') ?>

    <?= $form->field($model, 'ordate') ?>

    <?= $form->field($model, 'ortype') ?>

    <?= $form->field($model, 'brokerid') ?>

    <?= $form->field($model, 'exchid') ?>

    <?php // echo $form->field($model, 'companyid') ?>

    <?php // echo $form->field($model, 'qid') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'currencyid') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'stoploss') ?>

    <?php // echo $form->field($model, 'stopprice') ?>

    <?php // echo $form->field($model, 'takeprofit') ?>

    <?php // echo $form->field($model, 'takeprice') ?>

    <?php // echo $form->field($model, 'amountlot') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'brokerrevenue') ?>

    <?php // echo $form->field($model, 'orcomment') ?>

    <?php // echo $form->field($model, 'parentid') ?>

    <?php // echo $form->field($model, 'changedate') ?>

    <?php // echo $form->field($model, 'ActiveFlag') ?>

    <?php // echo $form->field($model, 'accountid') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
