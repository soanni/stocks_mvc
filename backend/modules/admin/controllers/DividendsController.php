<?php

namespace backend\modules\admin\controllers;

use yii\widgets\ActiveForm;
use yii\web\Response;
use common\models\dividend\Dividend;
use common\models\dividend\DividendSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii;

class DividendsController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new DividendSearch();
        $dataProvider = $searchModel->search();
        return $this->render('index',compact('searchModel','dataProvider'));
    }

    public function actionCreate()
    {
        $model = new Dividend();
        $model->on($model::EVENT_BEFORE_VALIDATE,[$model,'normalizeDates']);
        // AJAX validation
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        elseif ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('create', compact('model'));
            //return $this->renderPartial('create', compact('model'));
        }
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->renderPartial('view', compact('model'));
        //return $this->render('view', compact('model'));

    }

    /**
     * Deletes an existing Dividend model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Dividend model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dividend the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dividend::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}