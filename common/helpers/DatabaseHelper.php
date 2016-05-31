<?php


namespace common\helpers;

use yii\helpers\ArrayHelper;
use common\models\company\Company;
use common\models\exchange\Exchange;
use common\models\country\Country;
use common\models\quote\Quote;

class DatabaseHelper
{
    /**
     * helpers to generate dropdown list in update/create forms
     */
    public static function getCompaniesList(){
        return ArrayHelper::map(Company::find()->orderBy('companyname ASC')->all(),'companyid','companyname');
    }

    public static function getExchangesList(){
        return ArrayHelper::map(Exchange::find()->orderBy('exchname ASC')->all(),'exchid','exchname');
    }

    public static function getCountriesList(){
        return ArrayHelper::map(Country::find()->orderBy('countryname ASC')->all(),'countryid','countryname');
    }

    public static function getQuotesTickerList(){
        return ArrayHelper::map(Quote::find()->orderBy('acronym ASC')->all(),'qid','acronym');
    }

    public static function getQuotesFullnameList(){
        return ArrayHelper::map(Quote::find()->orderBy('fullname ASC')->all(),'qid','fullname');
    }
}