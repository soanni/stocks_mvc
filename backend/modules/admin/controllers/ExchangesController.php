<?php

namespace backend\modules\admin\controllers;

use Yii;
use common\models\exchange\Exchange;
use common\models\exchange\ExchangeSearch;
use common\models\company\Company;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExchangesController implements the CRUD actions for Exchange model.
 */
class ExchangesController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post']
                ],
            ],
        ];
    }

    /**
     * @param $exchid
     * AJAX from dividend create form
     * TODO transform to REST
     */
    public function actionGetCompaniesByExchange($exchid)
    {
        $model = new Exchange();
        $model->exchid = $exchid;
        $companies = $model->companies;

        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        $response->data = $companies;

        return $response;
    }

    /**
     * @param $exchid
     * AJAX from dividend create form
     * TODO transform to REST
     */
    public function actionGetQuotesByExchange($exchid)
    {
        $model = new Exchange();
        $model->exchid = $exchid;
        $quotes = $model->quotes;

        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        $response->data = $quotes;

        return $response;
    }

    /**
     * Lists all Exchange models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExchangeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Exchange model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Exchange model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Exchange();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->exchid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Exchange model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->exchid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Exchange model.
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
     * Finds the Exchange model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Exchange the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Exchange::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
