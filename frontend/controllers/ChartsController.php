<?php

namespace frontend\controllers;

use yii;
use yii\web\Controller;
use common\models\rate\Rate;
use common\models\quote\Quote;
use yii\web\Response;
use yii\web\NotFoundHttpException;

class ChartsController extends Controller
{
    public function actionView($id){
        //$quote = Quote::findOne($id);
        $rate = Rate::find()->where(['quoteid' => $id])->orderBy('ratedate DESC')->limit(1)->one();
        if ($rate !== null) {
            return $this->render('view',compact('rate'));
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetRatesJson($quoteid, $startdate, $enddate){
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        $response->data = $this->getRatesForPeriod($quoteid, $startdate, $enddate);

        return $response;
    }

    private function getRatesForPeriod($quoteid, $startdate, $enddate){
        $models = Rate::find()->select(['rate.ratedate','rate.maximum','rate.minimum','rate.openrate','rate.closerate'])
            ->join('INNER JOIN','quote','quote.qid = rate.quoteid')
            ->where('quote.qid = :qid',[':qid' => $quoteid])->andWhere(['between','rate.ratedate',$startdate,$enddate])
            ->all();
        $result = array();
        if(!empty($models)){
            foreach ($models as $model)
            {
                $result[] = $model->toArray();
            }
        }
        return $result;
    }
}