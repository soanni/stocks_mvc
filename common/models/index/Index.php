<?php

namespace common\models\index;

use common\helpers\DatabaseHelper;
use common\models\ActiveRecordTimestamp;
use Yii;
use common\models\country\Country;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\models\exchange\Exchange;
use common\models\quote\Quote;

/**
 * This is the model class for table "index".
 *
 * @property integer $indexid
 * @property integer $exchangeid
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
            [['exchangeid', 'indname', 'isin',], 'required'],
            ['exchangeid', 'in', 'range' => array_keys(DatabaseHelper::getExchangesList())],
            [['indname', 'isin'], 'string', 'max' => 255],
            [['indname','isin'],'trim'],
            ['indname','unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'indexid' => 'Index id',
            'exchangeid' => 'Exchange',
            'indname' => 'Index name',
            'isin' => 'ISIN',
            'ActiveFlag' => 'ActiveFlag',
            'ChangeDate' => 'ChangeDate',
        ];
    }

    ////////////////////// relations

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getExchange(){
        return $this->hasOne(Exchange::className(), ['exchid' => 'exchangeid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getQuotes(){
        return $this->hasMany(Quote::className(),['qid' => 'quoteid'])->viaTable('indiceslinks',['indid' => 'indexid']);
    }
}
