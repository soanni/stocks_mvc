<?php

namespace backend\admin;
use yii\base\Module;
use yii\helpers\Html;

class AdminModule extends Module
{
    public $generators;

    public function init()
    {
        parent::init();
        $this->generators = [
            [
                'name' => 'Exchanges',
                'link' => '@web/exchanges/index',
                'index_link' => Html::a('Start »', ['exchanges/index'], ['class' => 'btn btn-default']),
                'description' => 'Manage exchanges'
            ],
            [
                'name' => 'Countries',
                'link' => '@web/countries/index',
                'index_link' => Html::a('Start »', ['countries/index'], ['class' => 'btn btn-default']),
                'description' => 'Manage countries'
            ],
            [
                'name' => 'Currencies',
                'link' => '@web/currencies/index',
                'index_link' => Html::a('Start »', ['currencies/index'], ['class' => 'btn btn-default']),
                'description' => 'Manage currencies'
            ],
            [
                'name' => 'Companies',
                'link' => '@web/companies/index',
                'index_link' => Html::a('Start »', ['companies/index'], ['class' => 'btn btn-default']),
                'description' => 'Manage companies'
            ],
            [
                'name' => 'Quotes',
                'link' => '@web/quotes/index',
                'index_link' => Html::a('Start »', ['quotes/index'], ['class' => 'btn btn-default']),
                'description' => 'Manage quotes'
            ],
            [
                'name' => 'Rates',
                'link' => '@web/rates/index',
                'index_link' => Html::a('Start »', ['rates/index'], ['class' => 'btn btn-default']),
                'description' => 'Manage rates'
            ]
    }
}