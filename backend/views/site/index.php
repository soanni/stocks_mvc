<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = 'Admin panel';
?>

<div class="site-index">
    <div class="page-header">
        <h1>Stocks administration main page</h1>
    </div>
    <div class="body-content">
        <div class="row">
            <div class="generator col-lg-4">
                <h3>Exchanges, countries, currencies, quotes, rates, etc. management</h3>
                <p>The following section provides management facilities (CRUD) for basic application structures</p>
                <p><?= HTML::a('Start','/admin');?></p>
            </div>
             <div class="generator col-lg-4">
                <h3>User management</h3>
                <p>User management section. Assigned roles, permissions</p>
                <p><?= HTML::a('Start','');?></p>
            </div>
            <div class="generator col-lg-4">
                <h3>Orders management</h3>
                <p>Orders management section</p>
                <p><?= HTML::a('Start','');?></p>
            </div>
        </div>
    </div>
</div>
