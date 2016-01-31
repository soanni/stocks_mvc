<?php

namespace common\models\index;

use common\models\ActiveRecordTimestamp;
use Yii;
use common\models\country\Country;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "index".
 *
 * @property integer $indexid
 * @property integer $countryid
 * @property string $indname
 * @property string $isin
 * @property integer $ActiveFlag
 * @property string $ChangeDate
 *
 * @property Country $country
 */
class Index extends ActiveRecordTimestamp
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'index';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['countryid', 'indname', 'isin', 'ActiveFlag', 'ChangeDate'], 'required'],
            [['countryid', 'ActiveFlag'], 'integer'],
            [['ChangeDate'], 'safe'],
            [['indname', 'isin'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'indexid' => 'Index id',
            'countryid' => 'Country',
            'indname' => 'Index name',
            'isin' => 'ISIN',
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
}
