<?php 
namespace backend\controllers;

use Yii;
use yii\web\Controller;

class AppController extends Controller
{
    
    public function beforeAction($action)
    {
       if(Yii::$app->session->has('language')){
            Yii::$app->language = Yii::$app->session->get('language');
       }
       else{
            Yii::$app->language = Yii::$app->params['mainlanguage'];
       }
       return parent::beforeAction($action);
    }

}