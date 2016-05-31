<?php

namespace common\models\currency;

use common\helpers\DatabaseHelper;
use Yii;
use common\models\country\Country;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "currency".
 *
 * @property integer $curid
 * @property string $acronym
 * @property string $curname
 * @property integer $countryid
 *
 * @property Country $country
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['curname','acronym','countryid'],'required'],
            ['countryid', 'in','range' => array_keys(DatabaseHelper::getCountriesList())],
            ['curname', 'unique'],
            [['acronym', 'curname'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'curid' => 'Currency id',
            'acronym' => 'Acronym',
            'curname' => 'Currency',
            'countryid' => 'Country',
        ];
    }

    /////////////////////////////Relations

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['countryid' => 'countryid']);
    }


}
