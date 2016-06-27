<?php

namespace common\models\country;

use Yii;
use common\models\company\Company;
use common\models\currency\Currency;
use common\models\exchange\Exchange;

/**
 * This is the model class for table "country".
 *
 * @property integer $countryid
 * @property string $countryname
 * @property string $acronym
 *
 * @property Companies[] $companies
 * @property Currencies[] $currencies
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['countryname', 'acronym'], 'required'],
            [['countryname'], 'unique'],
            [['countryname', 'acronym'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'countryid' => 'Country Id',
            'countryname' => 'Country',
            'acronym' => 'Acronym',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExchanges()
    {
        return $this->hasMany(Exchange::className(), ['countryid' => 'countryid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Company::className(), ['countryid' => 'countryid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencies()
    {
        return $this->hasMany(Currency::className(), ['countryid' => 'countryid']);
    }

    // validation in dividends create form
    // in case JS is off

    /**
     * @param $exchid
     * @return bool
     */
    public function hasExchange($exchid)
    {
        return $this->getExchanges()->where(['exchid' => $exchid])->exists();
    }
}
