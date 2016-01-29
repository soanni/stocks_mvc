<?php

use yii\widgets\ActiveForm;
use common\helpers\DatabaseHelper;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\currency\Currency */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="currency-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'acronym')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'curname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'countryid')->dropDownList(DatabaseHelper::getCountriesList(),['prompt' => 'Select country']);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
