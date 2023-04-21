<?php

namespace backend\controllers;

use Yii;
use app\models\Step;
use app\models\Unit;
use yii\filters\VerbFilter;
use backend\models\StepSearch;
use yii\web\NotFoundHttpException;
use backend\controllers\AppController;

/**
 * StepController implements the CRUD actions for Step model.
 */
class StepController extends AppController
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
     * Lists all Step models.
     *
     * @return string
     */
    public function actionIndex()
    {
        // $searchModel = new StepSearch();
        $searchModel = new Step();
        $unit = new Unit();
        // $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            // 'searchModel' => $searchModel,
            'step' => $searchModel::find()->with('unit')->orderBy(['id'=>SORT_DESC])->all(),
            // 'unit' => $unit::getUnit(),
            'unit'=> Unit::find()->orderBy(['id'=>SORT_DESC])->all(),
            // 'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Step model.
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
     * Creates a new Step model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Step();

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
     * Updates an existing Step model.
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
     * Deletes an existing Step model.
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
     * Finds the Step model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Step the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Step::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionUpdateIntro()
    {
        if($this->request->isPost){
            $unit = Yii::$app->request->post('unit');
            $intro = Yii::$app->request->post('intro');
            $query = Step::find()->where(['unit_id'=> $unit])->one();
            $query->note_intro = $intro;
            $query->intro = 1;
            $query->save();
        }
    }
    public function actionUpdateZalo()
    {
        if($this->request->isPost){
            $unit = Yii::$app->request->post('unit');
            $zalo = Yii::$app->request->post('zalo');
            $query = Step::find()->where(['unit_id'=> $unit])->one();
            $query->note_zalo = $zalo;
            $query->zalo = 1;
            $query->save();
        }
    }
    public function actionCheckIntro()
    {
        if($this->request->isPost){
            $unit = Yii::$app->request->post('unit');
            $val = Yii::$app->request->post('val');
            $query = Step::find()->where(['unit_id'=> $unit])->one();
            $query->intro = $val;
            $query->save();
        }
    }
    public function actionCheckZalo()
    {
        if($this->request->isPost){
            $unit = Yii::$app->request->post('unit');
            $val = Yii::$app->request->post('val');
            $query = Step::find()->where(['unit_id'=> $unit])->one();
            $query->zalo = $val;
            $query->save();
        }
    }

    public function actionAdd()
    {
        $model = new Step();
        if($this->request->isPost){
            $unit = Yii::$app->request->post('unit');
            $model->unit_id = $unit;
            $model->save();
        }
    }
}
