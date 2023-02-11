<?php

namespace backend\controllers;

use Yii;
use Exception;
use yii\web\UploadedFile;
use app\models\Categories;
use common\units\BaseUnits;
use yii\filters\VerbFilter;
use backend\models\UploadForm;
use yii\web\NotFoundHttpException;
use backend\models\CategoriesSearch;
use backend\controllers\AppController;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

/**
 * CategoriesController implements the CRUD actions for Categories model.
 */
class CategoriesController extends AppController
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
     * Lists all Categories models.
     *
     * @return string
     */
    // public function actionIndex()
    // {
        
    //     $searchModel = new CategoriesSearch();
    //     Yii::$app->session->set(self::className() . 'queryParams', Yii::$app->request->queryParams);
    //     $dataProvider = $searchModel->search($this->request->queryParams);

    //     return $this->render('index', [
    //         'searchModel' => $searchModel,
    //         'dataProvider' => $dataProvider,
    //     ]);
    // }

    public function actionIndex()
    {
        $model = new UploadForm();
        if ($model->load(Yii::$app->request->post())) {
        $model->file_path = $file = UploadedFile::getInstance($model, 'file_path');
        if (!empty($file)) {
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

        $searchModel = new CategoriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'model' => $model
        ]);
    }

    /**
     * Displays a single Categories model.
     * @param int $id
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
     * Creates a new Categories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Categories();

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
     * Updates an existing Categories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
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
     * Deletes an existing Categories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Categories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Categories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categories::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionExportExcel(){
        $searchModel = new CategoriesSearch();
        $queryParams = Yii::$app->session->get(self::className() . 'queryParams');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $max = 30;
        if ($dataProvider->totalCount > $max) {
        Yii::$app->session->setFlash('error', Yii::t('app', 'Không thể thực hiện do số lượng dữ liệu vượt quá {max}. Vui lòng lọc thêm dữ liệu', ['max' => $max]));
        return $this->redirect('index');
        }
        if ($dataProvider->totalCount == 0) {
        
        Yii::$app->session->setFlash('error', Yii::t('app', 'Không có dữ liệu để export'));
        return $this->redirect('index');
        }
        $fields = [
        [
        'attribute' => 'name'
        ],
        ];
        BaseUnits::exportExcel($queryParams, CategoriesSearch::className(), 'Danh sách thể loại', $fields, 'export category');
    }   
    public function importExcel($path) {
        $listAttr = ['name'];
        
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
        
        $query = Categories::getDb()->createCommand()->batchInsert(Categories::tableName(), $listAttr, $insertData)->getRawSql();
        try {
            Categories::getDb()->createCommand()->setRawSql($query)->execute();
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
        ];
        
        $t['name'] = Yii::t('app', 'name');
        $excelData[] = $t;
        BaseUnits::exportExcelTemp('', $fields, 'template_import_categories', $excelData);
    }
}
