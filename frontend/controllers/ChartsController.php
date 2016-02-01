<?php

namespace frontend\controllers;

use yii;
use yii\web\Controller;
use common\models\rate\Rate;
use yii\web\Response;

class ChartsController extends Controller
{
    public function actionGetRatesJson($quoteid, $startdate, $enddate){
        $models = Rate::find()->select(['rate.ratedate','rate.maximum','rate.minimum','rate.openrate','rate.closerate'])
            ->join('INNER JOIN','quote','quote.qid = rate.quoteid')
            ->where('quote.qid = :qid',[':qid' => $quoteid])->andWhere(['between','rate.ratedate',$startdate,$enddate])
            ->all();
        $result = array();
        if(!empty($models)){
            foreach ($models as $model)
            {
                $result[] = array('ratedate' => $model->ratedate
                                ,'maximum' => $model->maximum
                                ,'minimum' => $model->minimum
                                ,'openrate' => $model->openrate
                                ,'closerate' => $model->closerate);
            }
        }

        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        $response->data = $result;

        return $response;
    }
}