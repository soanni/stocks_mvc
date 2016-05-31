<?php

namespace common\models\company;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\company\Company;

/**
 * CompanySearch represents the model behind the search form about `common\models\company\Company`.
 */
class CompanySearch extends Company
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['companyid', 'countryid', 'ActiveFlag'], 'integer'],
            [['companyname', 'web', 'ChangeDate'], 'safe'],
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
        $query = Company::find();

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
            'companyid' => $this->companyid,
            'countryid' => $this->countryid,
            'ActiveFlag' => $this->ActiveFlag,
            'ChangeDate' => $this->ChangeDate,
        ]);

        $query->andFilterWhere(['like', 'companyname', $this->companyname])
            ->andFilterWhere(['like', 'web', $this->web]);

        return $dataProvider;
    }
}
