<?php

namespace common\models\dividend;

use yii\data\ActiveDataProvider;
use common\helpers\DatabaseHelper;

class DividendSearch extends Dividend
{

    public function search(){
        $query = Dividend::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $dataProvider;
    }
}