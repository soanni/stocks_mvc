<?php

namespace backend\modules\api\controllers;


use yii\rest\ActiveController;

class CompaniesController extends ActiveController
{
    public $modelClass = 'common\models\company\Company';

    public function actions()
    {
        return [
            'index' => [
                'class' => 'yii\rest\IndexAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
                'prepareDataProvider' => function($action){
                    return [0,1];
                }
            ]
        ];
    }
//    public function actionIndex($exchid = null){
//        if(!is_null($exchid)){
//            return [0,1];
//        }
//    }
}