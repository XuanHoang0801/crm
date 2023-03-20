<?php

namespace backend\controllers;

use Yii;
use Exception;
use app\models\Unit;
use yii\web\UploadedFile;
use common\units\BaseUnits;
use yii\filters\VerbFilter;
use backend\models\UnitSearch;
use backend\models\UploadForm;
use yii\web\NotFoundHttpException;
use backend\controllers\AppController;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

/**
 * UnitController implements the CRUD actions for Unit model.
 */
class UnitController extends AppController
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
     * Lists all Unit models.
     *
     * @return string
     */
    public function actionIndex()
    {

        $model = new UploadForm();
        if ($model->load(Yii::$app->request->post())) {
        $model->file_path = $file = UploadedFile::getInstance($model, 'file_path');
        if (!empty($file)) {
        $savePath =  'uploads/'.BaseUnits::generateDateTimeFileName('IMPORT_UNIT', $file->extension);
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
        $searchModel = new UnitSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    /**
     * Displays a single Unit model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Unit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Unit();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Unit model.
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
     * Deletes an existing Unit model.
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
     * Finds the Unit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Unit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Unit::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function importExcel($path) {
        $listAttr = ['unit_code', 'type_unit_id','name','belong_unit_id','province_id','link'];
        
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
        for ($row = 3; $row <= $highestRow; $row++) {
            $item = [];
            for ($col = 1; $col <= $highestColumnIndex; $col++) {
            $item[$listAttr[$col-1]] = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
            }
            if (!$this->validateRow($item)) {
            \Yii::$app->session->setFlash('error', \Yii::t('app', ' : ' . $row));
            return false;
            }
            $insertData[] = $item;
        
        }
        
        $query = Unit::getDb()->createCommand()->batchInsert(Unit::tableName(), $listAttr, $insertData)->getRawSql();
        try {
            Unit::getDb()->createCommand()->setRawSql($query)->execute();
        } catch (Exception $e) {
        \Yii::$app->session->setFlash('error', \Yii::t('app', 'System error'));
        return false;
        }
        
        return true;
        
        }
        
        private function validateRow($rowData)
        {
        if(!($rowData['name'] && $rowData['unit_code'] && $rowData['type_unit_id'] && $rowData['belong_unit_id'] && $rowData['province_id'])  ){
        return false;
        }
        return true;
        
    }   

    public function actionDownloadTemplate() {
        $fields = [
            [
                'label' => 'unit_code',
            'attribute' => 'unit_code',
            ],
            [
                'label' => 'type_unit_id',
            'attribute' => 'type_unit_id',
            ],
            [
                'label' => 'name',
            'attribute' => 'name',
            ],
            [
                'label' => 'belong_unit_id',
            'attribute' => 'belong_unit_id',
            ],
            [
                'label' => 'province_id',
            'attribute' => 'province_id',
            ],
            [
                'label' => 'link',
            'attribute' => 'link',
            ],
        ];
        
        $t['unit_code'] = Yii::t('app', 'Mã đơn vị');
        $t['type_unit_id'] = Yii::t('app', 'Loại đơn vị');
        $t['name'] = Yii::t('app', 'Tên đơn vị');
        $t['belong_unit_id'] = Yii::t('app', 'Đơn vị trực thuộc');
        $t['province_id'] = Yii::t('app', 'Mã tỉnh');
        $t['link'] = Yii::t('app', 'Link');
        $excelData[] = $t;
        BaseUnits::exportExcelTemp('', $fields, 'template_import_unit', $excelData);
    }
}
