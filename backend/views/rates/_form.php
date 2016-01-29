<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\DatabaseHelper;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\rates\Rate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rate-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'quoteid')->dropDownList(DatabaseHelper::getQuotesFullnameList(),['prompt' => 'Select quote']); ?>

    <div class="form-group">
        <?= Html::label('Company','rate-company',['class' => 'control-label']);?>
        <?= Html::input('string','rate-company',null,['readonly' => true, 'class' => 'form-control']);?>
    </div>
    <div class="form-group">
        <?= Html::label('Country','rate-country',['class' => 'control-label']);?>
        <?= Html::input('string','rate-country',null,['readonly' => true, 'class' => 'form-control']);?>
    </div>

    <?= $form->field($model, 'openrate')->input('number') ?>

    <?= $form->field($model, 'closerate')->input('number');?>

    <?= $form->field($model, 'ratedate')->widget(DatePicker::className(),['language' => 'en','dateFormat' => 'dd/MM/yyyy','class' => 'form-control']); ?>

    <?= $form->field($model, 'minimum')->input('number');?>

    <?= $form->field($model, 'maximum')->input('number');?>

    <?= $form->field($model, 'lastdeal')->input('number');?>

    <?= $form->field($model, 'deals')->input('number');?>

    <?= $form->field($model, 'wa')->input('number');?>

    <?= $form->field($model, 'dayval')->input('number');?>

    <?= $form->field($model, 'dayvol')->input('number');?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
