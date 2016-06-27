<?php

namespace backend\modules\admin\controllers;

use Yii;
use common\models\company\Company;
use common\models\company\CompanySearch;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * CompaniesController implements the CRUD actions for Company model.
 */
class CompaniesController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'restore' => ['post']
                ],
            ],
        ];
    }

    /**
     * @param $exchid
     * AJAX from dividend create form
     * TODO transform to REST
     */
    public function actionGetQuotesByCompany($companyid)
    {
        $model = new Company();
        $model->companyid = $companyid;
        $quotes = $model->quotes;

        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        $response->data = $quotes;

        return $response;
    }

    /**
     * setting flag ActiveFlag back to 1
     * AJAX action
     * @param $id integer
     * @return mixed
     * @see SoftDeleteBehavior::restore()
     */
    public function actionRestore($id)
    {
        $model = $this->findModel($id);
        $model->on(SoftDeleteBehavior::EVENT_BEFORE_RESTORE,[$model,'updateChangeDateOnRestoreAndSoftDelete']);
        $model->restore();
        return $this->redirect(['index']);
    }

    /**
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Company model.
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
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Company();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->companyid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->companyid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Company model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->on(SoftDeleteBehavior::EVENT_BEFORE_SOFT_DELETE,[$model,'updateChangeDateOnRestoreAndSoftDelete']);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
