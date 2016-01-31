<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\index\Index */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="index-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'countryid')->textInput() ?>

    <?= $form->field($model, 'indname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ActiveFlag')->textInput() ?>

    <?= $form->field($model, 'ChangeDate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
