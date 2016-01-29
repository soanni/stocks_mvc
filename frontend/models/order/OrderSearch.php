<?php

namespace frontend\models\order;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\order\Order;

/**
 * OrderSearch represents the model behind the search form about `frontend\models\order\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orid', 'ortype', 'brokerid', 'exchid', 'companyid', 'qid', 'amount', 'currencyid', 'stoploss', 'takeprofit', 'amountlot', 'parentid', 'ActiveFlag', 'accountid'], 'integer'],
            [['ordate', 'orcomment', 'changedate'], 'safe'],
            [['price', 'stopprice', 'takeprice', 'total', 'brokerrevenue'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Order::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'orid' => $this->orid,
            'ordate' => $this->ordate,
            'ortype' => $this->ortype,
            'brokerid' => $this->brokerid,
            'exchid' => $this->exchid,
            'companyid' => $this->companyid,
            'qid' => $this->qid,
            'amount' => $this->amount,
            'currencyid' => $this->currencyid,
            'price' => $this->price,
            'stoploss' => $this->stoploss,
            'stopprice' => $this->stopprice,
            'takeprofit' => $this->takeprofit,
            'takeprice' => $this->takeprice,
            'amountlot' => $this->amountlot,
            'total' => $this->total,
            'brokerrevenue' => $this->brokerrevenue,
            'parentid' => $this->parentid,
            'changedate' => $this->changedate,
            'ActiveFlag' => $this->ActiveFlag,
            'accountid' => $this->accountid,
        ]);

        $query->andFilterWhere(['like', 'orcomment', $this->orcomment]);

        return $dataProvider;
    }
}
