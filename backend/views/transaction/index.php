<?php

use app\models\Package;
use app\models\Unit;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use app\models\Transaction;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/** @var yii\web\View $this */
/** @var backend\models\TransactionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Giao dịch');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Tạo giao dịch'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'code',
            [
                'attribute' => 'unit_id',
                'value' => 'unit.name',
                'headerOptions' => ['style' => 'width:15%'],   

               'filter' => Select2::widget(
                [
                    'model' => $searchModel,
                    'attribute' => 'unit_id',
                    'data' => ArrayHelper::map(Unit::getUnit(), 'unit_code', 'name'),
                    'options' => ['placeholder' => 'All'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]),
            ],
            [
                'attribute' => 'time_start',
                'headerOptions' => ['style' => 'width:10%'],   
            ],  
            [
                'attribute' => 'time_end',
                'headerOptions' => ['style' => 'width:10%'],   
            ],  
            [
                'attribute' => 'package_id',
                'value' => 'package.name',
                'headerOptions' => ['style' => 'width:15%'],   

               'filter' => Select2::widget(
                [
                    'model' => $searchModel,
                    'attribute' => 'package_id',
                    'data' => ArrayHelper::map(Package::getPackage(), 'code', 'name'),
                    'options' => ['placeholder' => 'All'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]),
            ],
            'total',
            [
                'attribute' => 'status',
                'value' => function($searchModel){
                    if($searchModel->status == 0){
                        return Yii::t('app','Chưa giao dịch');
                    }
                    if($searchModel->status == 1){
                        return Yii::t('app','Đã giao dịch');
                    }
                    if($searchModel->status == 2){
                        return Yii::t('app','Giao dịch thành công');
                    }
                },
                'headerOptions' => ['style' => 'width:15%'],   

               'filter' => Select2::widget(
                [
                    'model' => $searchModel,
                    'attribute' => 'status',
                    'data' => Transaction::getStatus(),
                    'options' => ['placeholder' => 'All'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]),
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Transaction $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
