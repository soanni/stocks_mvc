<?php

namespace common\models\currency;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\currency\Currency;

/**
 * CurrencySearch represents the model behind the search form about `common\models\currency\Currency`.
 */
class CurrencySearch extends Currency
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['curid', 'countryid'], 'integer'],
            [['acronym', 'curname'], 'safe'],
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
        $query = Currency::find();

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
            'curid' => $this->curid,
            'countryid' => $this->countryid,
        ]);

        $query->andFilterWhere(['like', 'acronym', $this->acronym])
            ->andFilterWhere(['like', 'curname', $this->curname]);

        return $dataProvider;
    }
}
