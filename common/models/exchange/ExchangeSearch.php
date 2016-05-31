<?php

namespace common\models\exchange;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\exchange\Exchange;
use common\helpers\DatabaseHelper;

/**
 * ExchangeSearch represents the model behind the search form about `common\models\exchange\Exchange`.
 */
class ExchangeSearch extends Exchange
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exchid'], 'integer'],
            ['countryid', 'in', 'range' => array_keys(DatabaseHelper::getCountriesList())],
            [['exchname', 'web'], 'safe'],
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
        $query = Exchange::find();

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
            'exchid' => $this->exchid,
            'countryid' => $this->countryid,
        ]);

        $query->andFilterWhere(['like', 'exchname', $this->exchname])
            ->andFilterWhere(['like', 'web', $this->web]);

        return $dataProvider;
    }
}
