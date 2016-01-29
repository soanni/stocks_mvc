<?php

namespace backend\models;

use yii\helpers\Html;

class Site extends \yii\base\Model
{
    private $items;
    public function getItems()
    {
        $this->items = [
            [
                'name' => 'Exchanges',
                'index_link' => Html::a('Start »', ['exchanges/index'], ['class' => 'btn btn-default']),
                'description' => 'Manage exchanges'
            ],
            [
                'name' => 'Countries',
                'index_link' => Html::a('Start »', ['countries/index'], ['class' => 'btn btn-default']),
                'description' => 'Manage countries'
            ],
            [
                'name' => 'Currencies',
                'index_link' => Html::a('Start »', ['currencies/index'], ['class' => 'btn btn-default']),
                'description' => 'Manage currencies'
            ],
            [
                'name' => 'Companies',
                'index_link' => Html::a('Start »', ['companies/index'], ['class' => 'btn btn-default']),
                'description' => 'Manage companies'
            ],
            [
                'name' => 'Quotes',
                'index_link' => Html::a('Start »', ['quotes/index'], ['class' => 'btn btn-default']),
                'description' => 'Manage quotes'
            ],
            [
                'name' => 'Rates',
                'index_link' => Html::a('Start »', ['rates/index'], ['class' => 'btn btn-default']),
                'description' => 'Manage rates'
            ]
        ];
        return $this->items;
    }
}