<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\index\IndexSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="index-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'indexid') ?>

    <?= $form->field($model, 'countryid') ?>

    <?= $form->field($model, 'indname') ?>

    <?= $form->field($model, 'isin') ?>

    <?= $form->field($model, 'ActiveFlag') ?>

    <?php // echo $form->field($model, 'ChangeDate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
