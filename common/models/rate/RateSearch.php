<?php

namespace common\models\rate;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\rate\Rate;

/**
 * RateSearch represents the model behind the search form about `common\models\rates\Rate`.
 */
class RateSearch extends Rate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rateid', 'quoteid', 'deals', 'dayval', 'dayvol', 'ActiveFlag'], 'integer'],
            [['openrate', 'closerate', 'minimum', 'maximum', 'lastdeal', 'wa'], 'number'],
            [['ratedate', 'ChangeDate'], 'safe'],
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
        $query = Rate::find();

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
            'rateid' => $this->rateid,
            'quoteid' => $this->quoteid,
            'openrate' => $this->openrate,
            'closerate' => $this->closerate,
            'ratedate' => $this->ratedate,
            'minimum' => $this->minimum,
            'maximum' => $this->maximum,
            'lastdeal' => $this->lastdeal,
            'deals' => $this->deals,
            'wa' => $this->wa,
            'dayval' => $this->dayval,
            'dayvol' => $this->dayvol,
            'ActiveFlag' => $this->ActiveFlag,
            'ChangeDate' => $this->ChangeDate,
        ]);

        return $dataProvider;
    }
}
