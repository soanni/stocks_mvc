<?php

    use yii\widgets\ActiveForm;
    use common\helpers\DatabaseHelper;
    use yii\jui\DatePicker;
    use yii\helpers\Html;

    /* @var $this yii\web\View */
    /* @var $model common\models\dividend\Dividend */
    /* @var $form yii\widgets\ActiveForm */
?>
<div class="dividend-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model,'exchid')->dropDownList(DatabaseHelper::getExchangesList(),['prompt' => 'Select exchange']); ?>
    <?= $form->field($model,'companyid')->dropDownList(DatabaseHelper::getCompaniesList(),['prompt' => 'Select company']); ?>
    <?= $form->field($model,'quoteid')->dropDownList(DatabaseHelper::getQuotesFullnameList(),['prompt' => 'Select share']); ?>
    <?= $form->field($model,'exdividenddate')->widget(DatePicker::className(),['language' => 'en','dateFormat' => 'dd/MM/yyyy','class' => 'form-control']); ?>
    <?= $form->field($model,'recorddate')->widget(DatePicker::className(),['language' => 'en','dateFormat' => 'dd/MM/yyyy','class' => 'form-control']); ?>
    <?= $form->field($model,'announcementdate')->widget(DatePicker::className(),['language' => 'en','dateFormat' => 'dd/MM/yyyy','class' => 'form-control']); ?>
    <?= $form->field($model,'paymentdate')->widget(DatePicker::className(),['language' => 'en','dateFormat' => 'dd/MM/yyyy','class' => 'form-control']); ?>
    <?= $form->field($model,'currencyid')->dropDownList(DatabaseHelper::getCurrenciesList(),['prompt' => 'Select currency']); ?>
    <?= $form->field($model,'value')->input('number'); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

