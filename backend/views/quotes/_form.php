<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\DatabaseHelper;

/* @var $this yii\web\View */
/* @var $model common\models\quote\Quote */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quote-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shortname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'englishname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'acronym')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'exchid')->dropDownList(DatabaseHelper::getExchangesList(),['prompt' => 'Select exchange']);?>

    <?= $form->field($model, 'companyid')->dropDownList(DatabaseHelper::getCompaniesList(),['prompt' => 'Select company']);?>

    <?= $form->field($model, 'privileged')->checkbox();?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
