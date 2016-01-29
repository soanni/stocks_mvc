<?php

namespace common\models\rate;

use Yii;
use common\models\quote\Quote;

/**
 * This is the model class for table "rate".
 *
 * @property integer $rateid
 * @property integer $quoteid
 * @property string $openrate
 * @property string $closerate
 * @property string $ratedate
 * @property string $minimum
 * @property string $maximum
 * @property string $lastdeal
 * @property integer $deals
 * @property string $wa
 * @property integer $dayval
 * @property integer $dayvol
 * @property integer $ActiveFlag
 * @property string $ChangeDate
 *
 * @property Quote $quote
 */
class Rate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quoteid', 'ratedate', 'openrate', 'closerate', 'minimum', 'maximum'], 'required'],
            [['quoteid', 'deals', 'dayval', 'dayvol', 'ActiveFlag'], 'integer'],
            [['openrate', 'closerate', 'minimum', 'maximum', 'lastdeal', 'wa'], 'number'],
            [['ratedate', 'ChangeDate'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rateid' => 'Rateid',
            'quoteid' => 'Quote',
            'openrate' => 'Open rate',
            'closerate' => 'Close rate',
            'ratedate' => 'Rate date',
            'minimum' => 'Minimum',
            'maximum' => 'Maximum',
            'lastdeal' => 'Last deal',
            'deals' => 'Deals',
            'wa' => 'Wa',
            'dayval' => 'Day value',
            'dayvol' => 'Day volume',
            'ActiveFlag' => 'Active Flag',
            'ChangeDate' => 'Change Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuote()
    {
        return $this->hasOne(Quote::className(), ['qid' => 'quoteid']);
    }
}
