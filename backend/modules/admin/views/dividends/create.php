<?php
    use yii\helpers\Html;

    /* @var $this yii\web\View */
    /* @var $model common\models\dividend\Dividend */

    $this->title = 'Create dividend';
    $this->params['breadcrumbs'][] = ['label' => 'Dividends', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="dividend-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>