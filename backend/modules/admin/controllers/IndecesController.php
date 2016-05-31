<?php

namespace backend\modules\admin\controllers;


use Yii;
use yii\data\SqlDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\quote\QuoteSearch;
use common\models\index\Index;
use common\models\index\IndexSearch;

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

    // the list of quotes for selected exchange to appear in modal window
    public function actionAddQuotesToIndex(){
        $searchModel = new QuoteSearch();
        $params = array('QuoteSearch'=>array('exchid' => Yii::$app->request->get('exchid')));
        $dataProvider = $searchModel->search($params);
        $dataProvider->pagination->pageSize = 5;
        return $this->renderPartial('addQuotesToIndex',compact('searchModel','dataProvider'));
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
                'pageSize' => 5,
            ],
        ]);
        return $this->renderPartial('view',compact('model','dataProvider'));
    }

    /**
     * Creates a new Index model.
     * Creates links with quotes for new Index
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Index();
        $OK = true;
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $OK = $OK && $this->indexCreateUpdate($model,false);
            if($OK) return $this->redirect(['index']);
        }
        return $this->render('create', compact('model'));
    }

    /**
     * Updates an existing Index model.
     * And index links to quotes
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $OK = true;
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $OK = $OK && $this->indexCreateUpdate($model,true);
            if($OK) return $this->redirect(['index']);
        }
        return $this->render('update', compact('model'));
    }

    /**
     * Deletes an existing Index model.
     * Deletes all links to quotes for index
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $OK = true;
        $transaction = Yii::$app->db->beginTransaction();
        $model = $this->findModel($id);
        // delete records from table indiceslinks first to avoid foreign key constraint violation exception
        $OK = $OK && Yii::$app->db->createCommand()->delete('indiceslinks',['indid' => $model->indexid])->execute();
        $OK = $OK && $model->delete();
        if($OK) $transaction->commit();
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

    /**
     * Common function for actions create/update
     * @param Index $model
     * @param boolean $update
     * @return boolean
     */
    private function indexCreateUpdate(&$model, $update = false){
        $OK = true;
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            if(isset($_POST['IndexQuotes']) && !empty($_POST['IndexQuotes'])){
                $transaction = Yii::$app->db->beginTransaction();
                // first delete all linked quotes in table indeces links, then recreate them
                if($update) $OK = $OK && Yii::$app->db->createCommand()->delete('indiceslinks',['indid' => $model->indexid])->execute();
                $OK = $OK && $model->save();
                foreach($_POST['IndexQuotes'] as $qid){
                    $command = Yii::$app->db->createCommand()->insert('indiceslinks',[
                        'indid' => $model->indexid
                        ,'quoteid' => $qid
                    ]);
                    $OK = $OK && $command->execute();
                }
                if($OK){
                    $transaction->commit();
                    return true;
                }else{
                    $transaction->rollBack();
                    $model->addError('index','Some problems during transaction occured');
                }
            }
            else{
                $model->addError('quotes','The quotes list must be at least 1 item long');
            }
        }
        return false;
    }
}
