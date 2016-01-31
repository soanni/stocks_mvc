<?php

namespace backend\modules\admin;
use yii\base\Module;
use yii\helpers\Html;

class AdminModule extends Module
{
    public $generators;
    public $defaultRoute = 'exchanges';
    public $layout = 'index';

    public function init()
    {
        parent::init();
        $this->generators = [
            [
                'name' => 'Exchanges',
                'link' => '@web/admin/exchanges/index',
            ],
            [
                'name' => 'Countries',
                'link' => '@web/admin/countries/index',
            ],
            [
                'name' => 'Currencies',
                'link' => '@web/admin/currencies/index',
            ],
            [
                'name' => 'Companies',
                'link' => '@web/admin/companies/index',
            ],
            [
                'name' => 'Quotes',
                'link' => '@web/admin/quotes/index',
            ],
            [
                'name' => 'Rates',
                'link' => '@web/admin/rates/index',
            ],
            [
                'name' => 'Indeces',
                'link' => '@web/admin/indeces/index',
            ]
        ];
    }
}