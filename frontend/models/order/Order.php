<?php

namespace frontend\models\order;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $orid
 * @property string $ordate
 * @property integer $ortype
 * @property integer $brokerid
 * @property integer $exchid
 * @property integer $companyid
 * @property integer $qid
 * @property integer $amount
 * @property integer $currencyid
 * @property string $price
 * @property integer $stoploss
 * @property string $stopprice
 * @property integer $takeprofit
 * @property string $takeprice
 * @property integer $amountlot
 * @property string $total
 * @property string $brokerrevenue
 * @property string $orcomment
 * @property integer $parentid
 * @property string $changedate
 * @property integer $ActiveFlag
 * @property integer $accountid
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ordate', 'ortype', 'brokerid', 'exchid', 'companyid', 'qid', 'amount', 'currencyid', 'price', 'stoploss', 'stopprice', 'takeprofit', 'takeprice', 'amountlot', 'total', 'brokerrevenue', 'orcomment', 'changedate', 'ActiveFlag', 'accountid'], 'required'],
            [['ordate', 'changedate'], 'safe'],
            [['ortype', 'brokerid', 'exchid', 'companyid', 'qid', 'amount', 'currencyid', 'stoploss', 'takeprofit', 'amountlot', 'parentid', 'ActiveFlag', 'accountid'], 'integer'],
            [['price', 'stopprice', 'takeprice', 'total', 'brokerrevenue'], 'number'],
            [['orcomment'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orid' => 'Orid',
            'ordate' => 'Ordate',
            'ortype' => 'Ortype',
            'brokerid' => 'Brokerid',
            'exchid' => 'Exchid',
            'companyid' => 'Companyid',
            'qid' => 'Qid',
            'amount' => 'Amount',
            'currencyid' => 'Currencyid',
            'price' => 'Price',
            'stoploss' => 'Stoploss',
            'stopprice' => 'Stopprice',
            'takeprofit' => 'Takeprofit',
            'takeprice' => 'Takeprice',
            'amountlot' => 'Amountlot',
            'total' => 'Total',
            'brokerrevenue' => 'Brokerrevenue',
            'orcomment' => 'Orcomment',
            'parentid' => 'Parentid',
            'changedate' => 'Changedate',
            'ActiveFlag' => 'Active Flag',
            'accountid' => 'Accountid',
        ];
    }
}
