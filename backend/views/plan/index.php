<?php

use app\models\Plan;
use app\models\Unit;
use yii\helpers\Url;
use app\models\Staff;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/** @var yii\web\View $this */
/** @var backend\models\PlanSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Kế hoạch đào tạo');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Tạo kế hoạch'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'name',
            [
                'attribute' => 'customer_id',
                'value' => 'customer_id',
                'filter' => Select2::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'customer_id',
                        'data' => ArrayHelper::map(Staff::getStaff(), 'staff_code', 'staff_code'),
                        'options' => ['placeholder' => 'All'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]),
            ],
            
            

            [
                'attribute' => 'form',
                'value' => function($searchModel){
                    if($searchModel->form == 0){
                        return Yii::t('app','Trực tiếp');
                    }
                    if($searchModel->form == 1){
                        return Yii::t('app','Trực tuyến');
                    }
                    if($searchModel->form == 2){
                        return Yii::t('app','Kết hợp');
                    }
                },
               'filter' => Select2::widget(
                [
                    'model' => $searchModel,
                    'attribute' => 'form',
                    'data' => Yii::$app->params['plan.form'],
                    'options' => ['placeholder' => 'All'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]),
            ],
            'time_start',
            'time_end',
            
            [
                'attribute' => 'unit_id',
                'value' => 'unit_id',
               'filter' => Select2::widget(
                [
                    'model' => $searchModel,
                    'attribute' => 'unit_id',
                    'data' => ArrayHelper::map(Unit::getUnit(), 'unit_code', 'unit_code'),
                    'options' => ['placeholder' => 'All'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]),
            ],
            //'content:ntext',
            //'error:ntext',
            //'request',
            //'fix:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Plan $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
