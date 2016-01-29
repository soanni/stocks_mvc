<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\DatabaseHelper;

/* @var $this yii\web\View */
/* @var $model common\models\company\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'companyname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'web')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'countryid')->dropDownList(DatabaseHelper::getCountriesList(),['prompt' => 'Select country']);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
