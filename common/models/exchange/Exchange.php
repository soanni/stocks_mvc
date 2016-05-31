<?php

namespace common\models\exchange;

use Yii;
use common\helpers\DatabaseHelper;
use common\models\quote\Quote;
use common\models\country\Country;

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
}
