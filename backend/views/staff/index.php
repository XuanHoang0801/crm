<?php

use app\models\Province;
use yii\helpers\Url;
use app\models\Staff;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/** @var yii\web\View $this */
/** @var backend\models\StaffSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Nhân viên');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Staff'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'staff_code',
            [
                'attribute' => 'staff_code',
                'headerOptions' => ['style' => 'width:10%']           
            ],
            'name',
            [
                'attribute' => 'phone',
                'headerOptions' => ['style' => 'width:15%']           
            ],
            'email:email',
            // 'province.name',
            [
                'attribute' => 'province_id',
                'value'     => 'province.name',
                'headerOptions' => ['style' => 'width:20%'],        
                'filter' => Select2::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'province_id',
                        'data' => ArrayHelper::map(Province::getProvince(), 'province_code', 'name'),
                        'options' => ['placeholder' => 'All'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]),
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Staff $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
