<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\order\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ordate')->textInput() ?>

    <?= $form->field($model, 'ortype')->textInput() ?>

    <?= $form->field($model, 'brokerid')->textInput() ?>

    <?= $form->field($model, 'exchid')->textInput() ?>

    <?= $form->field($model, 'companyid')->textInput() ?>

    <?= $form->field($model, 'qid')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'currencyid')->textInput() ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stoploss')->textInput() ?>

    <?= $form->field($model, 'stopprice')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'takeprofit')->textInput() ?>

    <?= $form->field($model, 'takeprice')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amountlot')->textInput() ?>

    <?= $form->field($model, 'total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brokerrevenue')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'orcomment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parentid')->textInput() ?>

    <?= $form->field($model, 'changedate')->textInput() ?>

    <?= $form->field($model, 'ActiveFlag')->textInput() ?>

    <?= $form->field($model, 'accountid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
