<?php

namespace backend\controllers;

use app\models\Notify;
use Yii;
use Exception;
use app\models\Task;
use yii\web\UploadedFile;
use common\units\BaseUnits;
use yii\filters\VerbFilter;
use backend\models\TaskSearch;
use backend\models\UploadForm;
use yii\web\NotFoundHttpException;
use backend\controllers\AppController;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends AppController
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Task models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new UploadForm();
        if ($model->load(Yii::$app->request->post())) {
            $model->file_path = $file = UploadedFile::getInstance($model, 'file_path');
            if (!empty($file)) 
            {
                $savePath =  'uploads/'.BaseUnits::generateDateTimeFileName('IMPORT_CATEGORIES', $file->extension);
                if ($model->saveFile($savePath) && self::importExcel($savePath)) {
                    Yii::$app->session->setFlash('success', Yii::t('app', "Import successful"));
                }
                try {
                    unlink($savePath);
                } catch (Exception $exception) {
                    Yii::$app->session->setFlash('warning', Yii::t('app', "Delete file fail"));
                }
            }
        }

        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'model' => $model
        ]);
    }

    /**
     * Displays a single Task model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $notify = Notify::find()->where(['user_id' => Yii::$app->user->identity->id])->andWhere(['task_id'=>$id])->one();
        // var_dump($notify);die();
        if($notify){
            $notify->status = 1;
            $notify->save();
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Task();


        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->save();
                $notify = new Notify();

                $notify->title = $model->name;
                $notify->user_id = Yii::$app->user->identity->id;
                $notify->task_id = $model->id;
                $notify->status = 0;
                $notify->save();
                return $this->redirect(['update', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function importExcel($path) {
        $listAttr = ['name','url','database','table','status','note'];
        
        if(!file_exists($path) || !is_readable($path)) {
        \Yii::$app->session->setFlash('error', \Yii::t('app', 'File import not exist in server'));
        }
        
        try {
        $spreadsheet = IOFactory::load($path);
        } catch (Exception $e) {
        \Yii::$app->session->setFlash('warning', \Yii::t('app', 'Could not load file'));
        return false;
        }
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();
        $highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);
        
        if ($highestRow < 2) {
        \Yii::$app->session->setFlash('warning', \Yii::t('app', 'No data in file'));
        return false;
        }
        
        if ($highestColumnIndex != sizeof($listAttr)) {
        \Yii::$app->session->setFlash('error', \Yii::t('app', 'Wrong column number'));
        return false;
        }
        
        $insertData = [];
        for ($row = 2; $row <= $highestRow; $row++) {
            $item = [];
            for ($col = 1; $col <= $highestColumnIndex; $col++) {
            $item[$listAttr[$col - 1]] = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
            }
            if (!$this->validateRow($item)) {
            \Yii::$app->session->setFlash('error', \Yii::t('app', ' : ' . $row));
            return false;
            }
            $insertData[] = $item;
        
        }
        
        $query = Task::getDb()->createCommand()->batchInsert(Task::tableName(), $listAttr, $insertData)->getRawSql();
        try {
            Task::getDb()->createCommand()->setRawSql($query)->execute();
        } catch (Exception $e) {
        \Yii::$app->session->setFlash('error', \Yii::t('app', 'System error'));
        return false;
        }
        
        return true;
        
        }
        
        private function validateRow($rowData)
        {
        if(!($rowData['name'])){
        return false;
        }
        return true;
        
    }   
    public function actionDownloadTemplate() {
        $fields = [
            [
            'attribute' => 'name',
            'label' => 'name'
            ],
            [
            'attribute' => 'url',
            'label' => 'url'
            ],
            [
            'attribute' => 'database',
            'label' => 'database'
            ],
            [
            'attribute' => 'table',
            'label' => 'table'
            ],
            [
            'attribute' => 'status',
            'label' => 'status'
            ],
            [
            'attribute' => 'note',
            'label' => 'note'
            ],
        ];
        
        $t['name'] = Yii::t('app', 'name');
        $t['url'] = Yii::t('app', 'url');
        $t['database'] = Yii::t('app', 'database');
        $t['table'] = Yii::t('app', 'table');
        $t['status'] = Yii::t('app', 'status');
        $t['note'] = Yii::t('app', 'note');
        $excelData[] = $t;
        BaseUnits::exportExcelTemp('', $fields, 'template_import_task', $excelData);
    }
}
