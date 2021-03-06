<?php

namespace backend\modules\admin\controllers;

use Yii;
use common\models\rate\Rate;
use common\models\rate\RateSearch;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\CSV;
use common\models\UploadForm;
use yii\web\UploadedFile;
use common\models\quote\Quote;

/**
 * RatesController implements the CRUD actions for Rate model.
 */
class RatesController extends Controller
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
     * Lists all Rate models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rate model.
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
     * Creates a new Rate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rate();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->rateid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Rate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->rateid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Rate model.
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
     * Loading rates from CSV file
     */
    public function actionLoad()
    {
        $model = new UploadForm();

        if(Yii::$app->request->isPost){
            $model->csvFile = UploadedFile::getInstance($model, 'csvFile');
            if ($model->upload()) {
                try{
                    $csv = new CSV(Yii::getAlias('@uploads') . '/' . $model->csvFile->baseName . '.' . $model->csvFile->extension);
                    $models = Quote::findAll(['ActiveFlag' => 1]);
                    $filter = array();
                    foreach($models as $model){
                        $filter[strtoupper(trim($model->acronym))] = $model->qid;
                    }
                    $arr = $csv->getFilteredCSV($filter);
                    $this->batchInsertRows($arr);
                }catch(Exception $e){

                }
            }
        }
        else{
            return $this->render('load',['model' => $model]);
        }
    }

    /**
     * Finds the Rate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rate::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function batchInsertRows(Array $arr){
        set_time_limit(100);
        Yii::$app->db->createCommand()->batchInsert('rate',
            [
                'quoteid'
                ,'openrate'
                ,'closerate'
                ,'ratedate'
                ,'minimum'
                ,'maximum'
                ,'lastdeal'
                ,'deals'
                ,'wa'
                ,'dayval'
                ,'dayvol'
                ,'ActiveFlag'
            ],$arr)->execute();
    }
}
