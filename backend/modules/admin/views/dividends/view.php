<?php
    use yii\helpers\Html;
    use yii\widgets\DetailView;
    use yii\widgets\ListView;

    /* @var $this yii\web\View */
    /* @var $model common\models\dividend\Dividend */

    $this->title = $model->id;
    $this->params['breadcrumbs'][] = ['label' => 'Dividends', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="dividend-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'exchange.exchname',
            'company.companyname',
            'quote.fullname',
            'exdividenddate',
            'recorddate',
            'announcementdate',
            'paymentdate',
            'value',
            'currency.curname',
            'ActiveFlag',
            'ChangeDate'
        ]
    ]) ?>

</div>