<?php

namespace common\models\exchange;

use Yii;
use common\helpers\DatabaseHelper;
use common\models\quote\Quote;
use common\models\country\Country;
use common\models\company\Company;

/**
 * This is the model class for table "exchange".
 *
 * @property integer $exchid
 * @property integer $countryid
 * @property string $exchname
 * @property string $web
 *
 * @property Quotes[] $quotes
 */
class Exchange extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exchange';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exchname','web','countryid'], 'required'],
            [['exchname'], 'unique'],
            [['exchname', 'web'], 'string', 'max' => 255],
            ['countryid', 'in', 'range' => array_keys(DatabaseHelper::getCountriesList())]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'exchid' => 'Exchange Id',
            'exchname' => 'Exchange',
            'web' => 'Web',
        ];
    }

    // relations

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuotes()
    {
        return $this->hasMany(Quote::className(), ['exchid' => 'exchid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry(){
        return $this->hasOne(Country::className(),['countryid' => 'countryid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies(){
        return $this->hasMany(Company::className(),['companyid' => 'companyid'])->via('quotes');
    }

    // validation in dividends create form
    // in case JS is off

    /**
     * @param $companyid
     * @return bool
     */
    public function hasCompany($companyid)
    {
        return $this->getCompanies()->where(['companyid' => $companyid])->exists();
    }
}
