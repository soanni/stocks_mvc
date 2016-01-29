<?php

namespace common\models\company;

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
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * automatically changes date after save/insert/update
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['ChangeDate'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['ChangeDate'],
                ],
                'value' => new Expression('NOW()')
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['countryid', 'ActiveFlag'], 'integer'],
            [['companyname', 'countryid'], 'required'],
            [['companyname'], 'unique'],
            [['ChangeDate'], 'safe'],
            [['companyname', 'web'], 'string', 'max' => 255]
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
     * override beforeSave() to automatically set the ActiveFlag attribute
     */
    public function beforeSave($insert)
    {
        $return = parent::beforeSave($insert);
        if($this->isNewRecord){
            $this->ActiveFlag = 1;
        }
        return $return;
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
