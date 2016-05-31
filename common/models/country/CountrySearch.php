<?php

namespace common\models\country;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\country\Country;

/**
 * CountrySearch represents the model behind the search form about `common\models\country\Country`.
 */
class CountrySearch extends Country
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['countryid'], 'integer'],
            [['countryname', 'acronym'], 'safe'],
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
        $query = Country::find();

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
            'countryid' => $this->countryid,
        ]);

        $query->andFilterWhere(['like', 'countryname', $this->countryname])
            ->andFilterWhere(['like', 'acronym', $this->acronym]);

        return $dataProvider;
    }
}
