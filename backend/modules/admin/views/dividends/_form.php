<?php

    use yii\bootstrap\ActiveForm;
    use common\helpers\DatabaseHelper;
    use kartik\widgets\DatePicker;
    use yii\helpers\Html;

    /* @var $this yii\web\View */
    /* @var $model common\models\dividend\Dividend */
    /* @var $form yii\bootstrap\ActiveForm */
?>
<div class="dividend-form">
    <?php $form = ActiveForm::begin([
        'id' => 'dividend-create-form',
        'layout' => 'horizontal',
        'enableAjaxValidation' => true
    ]);
    ?>

    <?= $form->field($model,'country')->dropDownList(DatabaseHelper::getCountriesList(),['prompt' => 'Select country']); ?>
    <?= $form->field($model,'exchid')->dropDownList(DatabaseHelper::getExchangesList(),['prompt' => 'Select exchange']); ?>
    <?= $form->field($model,'companyid')->dropDownList(DatabaseHelper::getCompaniesList(),['prompt' => 'Select company']); ?>
    <?= $form->field($model,'quoteid')->dropDownList(DatabaseHelper::getQuotesFullnameList(),['prompt' => 'Select share']); ?>
    <?php
        //echo $form->field($model,'exdividenddate')->widget(DatePicker::className(),['language' => 'en','dateFormat' => 'dd/MM/yyyy','class' => 'form-control']);
        echo $form->field($model,'exdividenddate',['enableClientValidation' => false])->widget(DatePicker::className(),[
            'options' => [
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'placeholder' => 'Enter date',
                'class' => 'form-control',
                'readonly' => true
            ],
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd-M-yyyy'
            ]
        ]);
    ?>
    <?php
        //echo $form->field($model,'recorddate')->widget(DatePicker::className(),['language' => 'en','dateFormat' => 'dd/MM/yyyy','class' => 'form-control']);
        echo $form->field($model,'recorddate',['enableClientValidation' => false])->widget(DatePicker::className(),[
            'options' => [
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'placeholder' => 'Enter date',
                'class' => 'form-control',
                'readonly' => true
            ],
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd-M-yyyy'
            ]
        ]);
    ?>
    <?php
        //echo $form->field($model,'announcementdate')->widget(DatePicker::className(),['language' => 'en','dateFormat' => 'dd/MM/yyyy','class' => 'form-control']);
        echo $form->field($model,'announcementdate',['enableClientValidation' => false])->widget(DatePicker::className(),[
            'options' => [
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'placeholder' => 'Enter date',
                'class' => 'form-control',
                'readonly' => true
            ],
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd-M-yyyy'
            ]
        ]);
    ?>
    <?php
        //echo $form->field($model,'paymentdate')->widget(DatePicker::className(),['language' => 'en','dateFormat' => 'dd/MM/yyyy','class' => 'form-control']);
        echo $form->field($model,'paymentdate',['enableClientValidation' => false])->widget(DatePicker::className(),[
            'options' => [
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'placeholder' => 'Enter date',
                'class' => 'form-control',
                'readonly' => true
            ],
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd-M-yyyy'
            ]
        ]);
    ?>
    <?= $form->field($model,'currencyid')->dropDownList(DatabaseHelper::getCurrenciesList(),['prompt' => 'Select currency']); ?>
    <?= $form->field($model,'value')->input('number'); ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
