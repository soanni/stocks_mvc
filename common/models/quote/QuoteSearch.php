<?php

namespace common\models\quote;

use common\models\quote\Quote;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * QuoteSearch represents the model behind the search form about `common\models\quote\Quote`.
 */
class QuoteSearch extends Quote
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qid', 'exchid', 'companyid', 'privileged', 'ActiveFlag'], 'integer'],
            [['fullname', 'shortname', 'englishname', 'acronym', 'ChangeDate'], 'safe'],
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
        $query = Quote::find();

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
            'qid' => $this->qid,
            'exchid' => $this->exchid,
            'companyid' => $this->companyid,
            'privileged' => $this->privileged,
            'ActiveFlag' => $this->ActiveFlag,
            'ChangeDate' => $this->ChangeDate,
        ]);

        $query->andFilterWhere(['like', 'fullname', $this->fullname])
            ->andFilterWhere(['like', 'shortname', $this->shortname])
            ->andFilterWhere(['like', 'englishname', $this->englishname])
            ->andFilterWhere(['like', 'acronym', $this->acronym]);

        return $dataProvider;
    }
}
