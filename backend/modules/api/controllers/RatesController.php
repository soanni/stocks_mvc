<?php

namespace backend\modules\api\controllers;

use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use common\models\rate\Rate;

class RatesController extends ActiveController
{
    public $modelClass = 'common\models\rate\Rate';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['delete'], $actions['create'], $actions['update']);
        return $actions;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'indexWithQuote' => ['get']
            ]
        ];
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className()
        ];
        return $behaviors;
    }

    public function actionIndexWithQuote(){
        $_GET['expand'] = 'quote';
        return $this->runAction('index');
    }

}