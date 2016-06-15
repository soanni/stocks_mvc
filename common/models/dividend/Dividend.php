<?php

namespace common\models\dividend;

use common\helpers\DatabaseHelper;
use common\models\ActiveRecordTimestamp;
use common\models\currency\Currency;
use common\models\exchange\Exchange;
use common\models\quote\Quote;
use common\models\company\Company;
use yii;

/**
 * This is the model class for table dividends
 *
 * @property integer $id
 * @property integer $quoteid
 * @property integer $companyid
 * @property integer $exchid
 * @property string $exdividenddate
 * @property string $recorddate
 * @property string $announcementdate
 * @property string $paymentdate
 * @property string $value
 * @property integer $currencyid
 * @property integer $ActiveFlag
 * @property string $ChangeDate
 */
class Dividend extends ActiveRecordTimestamp
{

    public static function tableName()
    {
        return 'dividends';
    }

    public function rules()
    {
        return [
            [['quoteid','companyid','exchid','exdividenddate','recorddate','announcementdate','paymentdate','value','currencyid'],'required'],
            ['quoteid','in','range' => array_keys(DatabaseHelper::getQuotesFullnameList())],
            ['companyid','in','range' => array_keys(DatabaseHelper::getCompaniesList())],
            ['exchid','in','range' => array_keys(DatabaseHelper::getExchangesList())],
            //['countryid','in','range' => array_keys(DatabaseHelper::getCountriesList())],
            ['currencyid', 'in', 'range' => array_keys(DatabaseHelper::getCurrenciesList())],
            ['value','number'],
            [['exdividenddate','recorddate','announcementdate','paymentdate'],'date','format' => 'php:d/m/Y'],
            [['ActiveFlag','ChangeDate'],'safe']
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->exdividenddate = Yii::$app->formatter->asDate(date_create_from_format('d/m/Y',$this->exdividenddate),'php:Y-m-d');
            $this->recorddate = Yii::$app->formatter->asDate(date_create_from_format('d/m/Y',$this->recorddate),'php:Y-m-d');
            $this->announcementdate = Yii::$app->formatter->asDate(date_create_from_format('d/m/Y',$this->announcementdate),'php:Y-m-d');
            $this->paymentdate = Yii::$app->formatter->asDate(date_create_from_format('d/m/Y',$this->paymentdate),'php:Y-m-d');
            return true;
        } else {
            return false;
        }
    }

    public function getExchange(){
        return $this->hasOne(Exchange::className(), ['exchid' => 'exchid']);
    }

    public function getQuote(){
        return $this->hasOne(Quote::className(),['qid' => 'quoteid']);
    }

    public function getCompany(){
        return $this->hasOne(Company::className(),['companyid' => 'companyid']);
    }

    public function getCurrency(){
        return $this->hasOne(Currency::className(),['curid' => 'currencyid']);
    }
}