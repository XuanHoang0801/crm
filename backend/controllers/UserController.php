<?php

namespace backend\controllers;

use Yii;
use app\models\User;
use yii\filters\VerbFilter;
use backend\models\UserSearch;
use yii\web\NotFoundHttpException;
use backend\controllers\AppController;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends AppController
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
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User();

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
     * Updates an existing User model.
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
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionChangePassword($id)
    {
        $currentId = Yii::$app->user->identity->id;
        if ($currentId != $id) {
            \Yii::$app->user->logout();
            return $this->goHome();
        }
        $model = $this->findModel($id);
        $pass = $model->password_hash;
        if ($model->load(Yii::$app->request->post())) {
            $oldPass = trim(Yii::$app->request->post()[$model->formName()]['password_old']);
            if (password_verify($oldPass, $pass)) {
                $newPass = trim(Yii::$app->request->post()[$model->formName()]['password_new']);
                if ($oldPass != $newPass) {
                    $rePass = trim(Yii::$app->request->post()[$model->formName()]['re_password']);
                    if($rePass == $newPass){
                        $model->password_hash = Yii::$app->security->generatePasswordHash($newPass);
                        if ($model->save()) {
                            \Yii::$app->user->logout();
                            return $this->goHome();
                        }
                    }
                    else{
                    $model->addError('re_password', 'Mật khẩu không trùng khớp!');
                    }                   

                } else {
                    $model->addError('password_hash', 'Mật khẩu mới không được trùng với mật khẩu cũ!');
                }
            } else {
                $model->addError('password_old', 'Mật khẩu cũ không đúng!');
            }
        }
        
        return $this->render('change',[
            'model'=>$model
        ]);
        
    }
}
