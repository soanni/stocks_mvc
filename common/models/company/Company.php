<?php

namespace common\models\company;

use common\models\ActiveRecordTimestamp;
use Yii;
use common\models\country\Country;
use common\models\quote\Quote;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "company".
 *
 * @property integer $companyid
 * @property string $companyname
 * @property string $web
 * @property integer $countryid
 * @property integer $ActiveFlag
 * @property string $ChangeDate
 *
 * @property Country $country
 * @property Quotes[] $quotes
 */
class Company extends ActiveRecordTimestamp
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['countryid'], 'integer'],
            [['companyname', 'countryid'], 'required'],
            [['companyname'], 'unique'],
            [['companyname', 'web'], 'string', 'max' => 255],
            [['companyname', 'web'],'trim']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'companyid' => 'Company id',
            'companyname' => 'Company',
            'web' => 'Web',
            'countryid' => 'Country',
            'ActiveFlag' => 'ActiveFlag',
            'ChangeDate' => 'ChangeDate',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['countryid' => 'countryid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuotes()
    {
        return $this->hasMany(Quote::className(), ['companyid' => 'companyid']);
    }


}
