<?php

use app\models\Menu;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use kartik\select2\Select2;
/** @var yii\web\View $this */
/** @var backend\models\MenuParentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Menu cha');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Tạo menu cha mới'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            
            //'updated_at',
            //'type',
            [
                'attribute' => 'active',
                'value' => function($searchModel){
                    if($searchModel->active == 0){
                        return Yii::t('app','Ẩn');
                    }
                    if($searchModel->active == 1){
                        return Yii::t('app','Hiện');
                    }
                },

                'filter' => Select2::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'active',
                        'data' => Yii::$app->params['menu.active'],
                        'options' => ['placeholder' => 'All'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]),
                    
            ],
            //'icon',
            // 'active',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Menu $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
