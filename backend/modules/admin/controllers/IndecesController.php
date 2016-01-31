<?php

namespace backend\modules\admin\controllers;

use common\models\quote\Quote;
use Yii;
use common\models\index\Index;
use common\models\index\IndexSearch;
use yii\data\SqlDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IndecesController implements the CRUD actions for Index model.
 */
class IndecesController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Index models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IndexSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Index model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $count = Yii::$app->db->createCommand('SELECT COUNT(*)
                                               FROM quote q
                                               INNER JOIN indiceslinks lnk ON lnk.quoteid = q.qid
                                               WHERE lnk.indid = :id AND lnk.ActiveFlag = 1 AND q.ActiveFlag = 1',[':id' => $id])->queryScalar();
        $dataProvider = new SqlDataProvider([
            'sql' => 'SELECT q.fullname, q.acronym, q.privileged
                      FROM quote q
                      INNER JOIN indiceslinks lnk ON lnk.quoteid = q.qid
                      WHERE lnk.indid = :id AND lnk.ActiveFlag = 1 AND q.ActiveFlag = 1',
            'params' => [':id' => $id],
            //'pagination' => false
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->renderPartial('view',compact('model','dataProvider'));
    }

    /**
     * Creates a new Index model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Index();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->indexid]);
        } else {
            return $this->renderPartial('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Index model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->indexid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Index model.
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
     * Finds the Index model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Index the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Index::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
