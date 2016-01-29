<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\quote\QuoteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quote-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'qid') ?>

    <?= $form->field($model, 'fullname') ?>

    <?= $form->field($model, 'shortname') ?>

    <?= $form->field($model, 'englishname') ?>

    <?= $form->field($model, 'acronym') ?>

    <?php // echo $form->field($model, 'exchid') ?>

    <?php // echo $form->field($model, 'companyid') ?>

    <?php // echo $form->field($model, 'privileged') ?>

    <?php // echo $form->field($model, 'ActiveFlag') ?>

    <?php // echo $form->field($model, 'ChangeDate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
