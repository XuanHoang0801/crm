<?php

namespace backend\controllers;

use Yii;
use yii\web\Response;
// use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\LoginForm;
use yii\filters\AccessControl;
use backend\controllers\AppController;
use mdm\admin\models\form\ChangePassword;

/**
 * Site controller
 */
class SiteController extends AppController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error','language','captcha'],
                        'allow' => true,  
                    ],
                    [
                        'actions' => ['logout','index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];

        
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
    //                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'minLength' => 3,
                'maxLength' => 5,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionLanguage()
    {
            if(isset($_POST['lang'])){
                $lang = Yii::$app->language = $_POST['lang'];
                Yii::$app->getSession()->set('language', $lang);
            }
    }
}
