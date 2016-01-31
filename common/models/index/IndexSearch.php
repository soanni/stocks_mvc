<?php

namespace common\models\index;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\index\Index;

/**
 * IndexSearch represents the model behind the search form about `common\models\index\Index`.
 */
class IndexSearch extends Index
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['indexid', 'countryid', 'ActiveFlag'], 'integer'],
            [['indname', 'isin', 'ChangeDate'], 'safe'],
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
        $query = Index::find();

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
            'indexid' => $this->indexid,
            'countryid' => $this->countryid,
            'ActiveFlag' => $this->ActiveFlag,
            'ChangeDate' => $this->ChangeDate,
        ]);

        $query->andFilterWhere(['like', 'indname', $this->indname])
            ->andFilterWhere(['like', 'isin', $this->isin]);

        return $dataProvider;
    }
}
