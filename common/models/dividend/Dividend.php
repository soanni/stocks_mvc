<?php

namespace common\models\dividend;

use app\components\validators\CompanyValidator;
use app\components\validators\ExchangeValidator;
use app\components\validators\QuoteValidator;
use common\helpers\DatabaseHelper;
use common\models\ActiveRecordTimestamp;
use common\models\country\Country;
use common\models\currency\Currency;
use common\models\exchange\Exchange;
use common\models\quote\Quote;
use common\models\company\Company;
use yii\base\Event;
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
    /**
     * @var integer to select on the create form
     */
    public $country;

    public static function tableName()
    {
        return 'dividends';
    }

    public function rules()
    {
        return [
            [['quoteid','companyid','exchid','exdividenddate','recorddate','announcementdate','paymentdate','value','currencyid', 'country'],'required'],
            ['quoteid','in','range' => array_keys(DatabaseHelper::getQuotesFullnameList())],
            // in case JS is off and select fields are not automatically populated with the dependant values
            // we need to perform server side validation
            ['quoteid',QuoteValidator::className()],
            ['companyid','in','range' => array_keys(DatabaseHelper::getCompaniesList())],
            ['companyid', CompanyValidator::className()],
            ['exchid','in','range' => array_keys(DatabaseHelper::getExchangesList())],
            ['exchid', ExchangeValidator::className()],
            ['country','in','range' => array_keys(DatabaseHelper::getCountriesList())],
            ['currencyid', 'in', 'range' => array_keys(DatabaseHelper::getCurrenciesList())],
            ['value','number'],
            [['exdividenddate','recorddate','announcementdate','paymentdate'],'date','format' => 'php:Y-m-d'],
            [['ActiveFlag','ChangeDate'],'safe']
        ];
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

    /**
     * @param Event $event
     * Handler for EVENT_BEFORE_VALIDATE event
     * Handler will normalize dates from Datepicker widget
     */
    protected function normalizeDates(Event $event)
    {
        /**
         * @var Dividend $model
         */
        $model = $event->sender;
        $model->exdividenddate = Yii::$app->formatter->asDate(date_create_from_format('d-M-Y',$this->exdividenddate),'php:Y-m-d');
        $model->recorddate = Yii::$app->formatter->asDate(date_create_from_format('d-M-Y',$this->recorddate),'php:Y-m-d');
        $model->announcementdate = Yii::$app->formatter->asDate(date_create_from_format('d-M-Y',$this->announcementdate),'php:Y-m-d');
        $model->paymentdate = Yii::$app->formatter->asDate(date_create_from_format('d-M-Y',$this->paymentdate),'php:Y-m-d');
    }
}