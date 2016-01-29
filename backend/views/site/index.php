<?php

/* @var $this yii\web\View */

$this->title = 'Admin panel';
$controllers = $model->items;
?>

<div class="site-index">
    <div class="page-header">
        <h1>Stocks administration main page</h1>
    </div>
    <div class="body-content">
        <div class="row">
            <?php foreach ($controllers as $controller): ?>
                <div class="generator col-lg-4">
                    <h3><?= $controller['name'];?></h3>
                    <p><?= $controller['description'];?></p>
                    <p><?= $controller['index_link'];?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
