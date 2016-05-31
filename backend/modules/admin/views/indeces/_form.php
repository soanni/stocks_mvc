<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\helpers\DatabaseHelper;

/* @var $this yii\web\View */
/* @var $model common\models\index\Index */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="index-form">
    <?php $form = ActiveForm::begin(
        [
            'id' => 'form-index-create'
            ,'layout' => 'horizontal'
            ,'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                'horizontalCssClasses' => [
                    'label' => 'col-sm-2',
                    'offset' => 'col-sm-offset-4',
                    'wrapper' => 'col-sm-6',
                    'error' => '',
                    'hint' => '',
                ],
            ],
        ]);
    ?>
    <?php
        echo $form->errorSummary($model);
    ?>
    <?= $form->field($model, 'exchangeid')->dropDownList(DatabaseHelper::getExchangesList(),['prompt' => 'Select exchange']); ?>

    <?= $form->field($model, 'indname')->textInput(['maxlength' => true])->hint('Please provide the index name'); ?>

    <?= $form->field($model, 'isin')->textInput(['maxlength' => true])->hint('Please provide the index ISIN'); ?>

    <h2>Add quotes to index</h2>
    <hr/>
    <?=
        Html::button('Add quote',['id' => 'add-quote-index', 'class' => 'btn btn-primary btn-sm']);
    ?>
    <br/>
    <?= Html::beginTag('table',['id' => 'index-quotes','class' => ['table']]);?>
        <?php
            if(!empty($model->quotes)){
                echo Html::beginTag('tdody');
                foreach($model->quotes as $quote){
                    echo Html::beginTag('tr',['class' => 'quote-row']);
                        echo Html::beginTag('td',['class' => 'hidden']);
                            echo Html::input('hidden','IndexQuotes[]',$quote->qid);
                        echo Html::endTag('td');
                        echo Html::beginTag('td');
                            echo Html::encode($quote->fullname);
                        echo Html::endTag('td');
                        echo Html::beginTag('td');
                            echo Html::encode($quote->acronym);
                        echo Html::endTag('td');
                        echo Html::beginTag('td');
                            echo Yii::$app->formatter->asBoolean($quote->privileged);
                        echo Html::endTag('td');
                        echo Html::beginTag('td');
                            echo Html::beginTag('a');
                                echo Html::beginTag('span',['class' => 'glyphicon glyphicon-remove']);
                                echo Html::endTag('span');
                            echo Html::endTag('a');
                        echo Html::endTag('td');
                    echo Html::endTag('tr');
                }
                echo Html::endTag('tdody');
            }else{
                echo Html::tag('tbody');;
            }
        ?>
    <?= Html::endTag('table');?>
    <div class="form-group">
        <div class="col-lg-offset-11">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    <div id="context-menu" class="context-menu">
        <ul class="context-menu__items">
            <li class="context-menu__item">
                <a href="#" class="context-menu__link" data-action="Delete"><i class="fa fa-times"></i> Delete</a>
            </li>
        </ul>
    </div>
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
