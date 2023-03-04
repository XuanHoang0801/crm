<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use app\models\Categories;
use kartik\file\FileInput;
use yii\bootstrap4\LinkPager as Bootstrap4LinkPager;
use yii\grid\ActionColumn;
use yii\widgets\ActiveForm;
use yii\bootstrap5\LinkPager;
/** @var yii\web\View $this */
/** @var backend\models\CategoriesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
// $this->registerJsFile('js/check_box.js');
$this->title = Yii::t('app', 'Thể loại');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Tạo thể loại mới'), ['create'], ['class' => 'btn btn-success']) ?>
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
    <a href="<?= Url::to(['categories/download-template']) ?>" class="mt-3" style="color: red"><?= Yii::t('app', 'Download template') ?></a>
    <?php ActiveForm::end(); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Export Excel'), ['excel'], ['class' => 'btn btn-success mt-3']) ?>
    </p>
    <div class="delete" style="display:none">
        <button class="btn btn-danger" id="delete" >Xóa dữ liệu đã chọn</button>
        <button class="btn btn-danger" id="delete-all">Xóa tất cả</button>


    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],

            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            // 'created_at',
            // 'updated_at',
            // 'deleted_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Categories $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],

        ],
        'pager' => [

            'class' => Bootstrap4LinkPager::class,
        ],
    ]); ?>

</div>
