<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>
<div>
    <?php
        $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
        echo $form->field($model, 'csvFile')->fileInput(['required' => true]);
    ?>
    <div class="form-group">
        <?= Html::submitButton('Load', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table">
            <tbody>
            </tbody>
        </table>
    </div>
</div>
