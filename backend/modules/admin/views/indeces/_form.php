<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\DatabaseHelper;

/* @var $this yii\web\View */
/* @var $model common\models\index\Index */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="index-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'exchangeid')->dropDownList(DatabaseHelper::getExchangesList(),['prompt' => 'Select exchange']); ?>

    <?= $form->field($model, 'indname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isin')->textInput(['maxlength' => true]) ?>

    <h2>Add quotes to index</h2>
    <hr/>
    <?=
        //Html::button('Add quote',['onclick' => 'addRow("index-quotes")']);
        Html::button('Add quote',['id' => 'add-quote-index']);
    ?>
    <?= Html::button('Remove quote',['class' => 'delete-quote invisible','onclick' => 'deleteRow("index-quotes")']);?>
    <?= Html::beginTag('table',['id' => 'index-quotes','class' => ['table' ,'table-striped','table-bordered']]);?>
        <?= Html::beginTag('thead');?>
            <?= Html::beginTag('tr');?>
                <?= Html::tag('td','Quote');?>
                <?= Html::tag('td','Acronym');?>
                <?= Html::tag('td','Privileged');?>
            <?= Html::endTag('tr');?>
        <?= Html::endTag('thead');?>
    <?= Html::endTag('table');?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
    \yii\bootstrap\Modal::begin([
        'headerOptions' => ['id' => 'modal-header'],
        'id' => 'modal',
        'options' => ['class' => 'slide'],
        'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
    ]);
    echo "<div id='modal-body'></div>";
    \yii\bootstrap\Modal::end();
?>
