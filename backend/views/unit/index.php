<?php

use app\models\Unit;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use app\models\BelongUnit;
use app\models\TypeUnit;
use kartik\file\FileInput;
use yii\grid\ActionColumn;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\LinkPager;
/** @var yii\web\View $this */
/** @var backend\models\UnitSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->registerJsFile('@web/js/delete_unit.js', ['depends' =>  [yii\web\YiiAsset::className()], ]);

$this->title = Yii::t('app', 'Units');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="unit-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Unit'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    

    <fieldset class="form-group" style="border: solid 1px #ccc; padding: 10px;margin-top: 28px">
    <legend style="height: 2px">
        <b style="background: white; position: relative; top: -14px"><?= Yii::t('app', 'IMPORT EXCEL') ?></b>
    </legend>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model,'file_path')->widget(FileInput::classname(), [
        'options' => [
        'multiple' => false
        ],
        'pluginOptions' => [
        'allowedFileExtensions' => ['xls', 'xlsx'],
        'showPreview' => false,
        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => true,
        'overwriteInitial' => true,
        ],
        'pluginEvents' => [
        'fileerror' => 'function(event, data, msg) {alert (msg) ;}'
        ]
    ])->label(false) ?>
        <a href="<?= Url::to(['unit/download-template']) ?>" class="mt-3" style="color: red"><?= Yii::t('app', 'Download template') ?></a>
    <div class="delete" style="display:none">
        <button class="btn btn-danger" id="delete" >Xóa dữ liệu đã chọn</button>
        <button class="btn btn-danger" id="delete-all">Xóa tất cả</button>
    </div>
    <?php ActiveForm::end(); ?>
    

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],

            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'unit_code',
            [
                'attribute' => 'unit_code',
                'headerOptions' => ['style' => 'width:10%']           
            ],

            'name',
            [
                'attribute' => 'type_unit_id',
                'value'     => 'type.name',
                'headerOptions' => ['style' => 'width:20%'],
                'filter' => Select2::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'type_unit_id',
                        'data' => ArrayHelper::map(TypeUnit::getTypeUnit(), 'type_unit_code', 'name'),
                        'options' => ['placeholder' => 'All'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]),
            ],

            [
                'attribute' => 'belong_unit_id',
                'value'     => 'belong.name',
                'headerOptions' => ['style' => 'width:20%'],     
                'filter' => Select2::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'belong_unit_id',
                        'data' => ArrayHelper::map(BelongUnit::getBelongUnit(), 'belong_code', 'name'),
                        'options' => ['placeholder' => 'All'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]),
            ],
            [
                'attribute' => 'link',
                'headerOptions' => ['style' => 'width:20%']           

            ],
            //'type_customer_id',
            //'status',
            //'province_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Unit $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],

        ],
        'pager' => [

            'class' => LinkPager::class,
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
