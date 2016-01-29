<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\rates\RateSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rate-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'rateid') ?>

    <?= $form->field($model, 'quoteid') ?>

    <?= $form->field($model, 'openrate') ?>

    <?= $form->field($model, 'closerate') ?>

    <?= $form->field($model, 'ratedate') ?>

    <?php // echo $form->field($model, 'minimum') ?>

    <?php // echo $form->field($model, 'maximum') ?>

    <?php // echo $form->field($model, 'lastdeal') ?>

    <?php // echo $form->field($model, 'deals') ?>

    <?php // echo $form->field($model, 'wa') ?>

    <?php // echo $form->field($model, 'dayval') ?>

    <?php // echo $form->field($model, 'dayvol') ?>

    <?php // echo $form->field($model, 'ActiveFlag') ?>

    <?php // echo $form->field($model, 'ChangeDate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
