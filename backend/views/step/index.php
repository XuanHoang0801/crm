<?php

use app\models\Step;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\StepSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->registerJsFile('@web/js/note.js', ['depends' =>  [yii\web\YiiAsset::className()], ]);

$this->title = Yii::t('app', 'Steps');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="step-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php //echo Html::a(Yii::t('app', 'Create Step'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php 
        //  GridView::widget([
        // 'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        // 'columns' => [
        //     ['class' => 'yii\grid\SerialColumn'],

        //     'id',
        //     'unit_id',
        //     'step',
        //     'intro:boolean',
        //     'zalo:boolean',
        //     [
        //         'class' => ActionColumn::className(),
        //         'urlCreator' => function ($action, Step $model, $key, $index, $column) {
        //             return Url::toRoute([$action, 'id' => $model->id]);
        //          }
        //     ],
        // ],
        // ]); 
    ?>

    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Đơn vị</th>
        <th scope="col">Giới thiệu</th>
        <th scope="col">Zalo</th>
        <!-- <th scope="col">Hành động</th> -->
        </tr>
    </thead>
    <tbody>
        <?php  
            $stt=1; 
            foreach($step as $data){ 
        ?>
        <tr data-id="<?= $data->unit_id ?>">
            <th scope="row" class = "col-1"><?= $stt++ ?></th>
            <td class = col-4><?= $data->unit->name ?></td>
            <td>
                <?php
                    if($data->intro == 1){
                ?>
                    <input type="checkbox" class="form-control-check " name="intro" value="<?= $data->intro ?>" id="" title= "<?=$data->note_intro ?>" checked >                
                <?php }else{ ?>
                    <input type="checkbox" class="form-control-check" name="intro" value="<?= $data->intro ?>" title= "<?=$data->note_intro ?>" id="">                
                    
                <?php } ?>  
                    <i class="fas fa-pen cursor-pointer note"></i>

                    <!-- <i class="fas fa-check cursor-pointer off off-intro" style="display: none;"></i>    -->
                    <i class="fas fa-check cursor-pointer hide note-intro" style="display: none;"></i>
                    <textarea class="form-control text-note" name="" id="" cols="10" rows="1" placeholder="Ghi chú" style="display: none"><?=$data->note_intro ?></textarea>
            </td>
            <td>                
            <?php
                    if($data->zalo == 1){
                ?>
                    <input type="checkbox" class="form-control-check" name="zalo" value="<?= $data->zalo ?>" id="" title="<?=$data->note_zalo ?>" checked>                
                <?php }else{ ?>
                    <input type="checkbox" class="form-control-check" name="zalo" value="<?= $data->zalo ?>" id="" title="<?=$data->zalo ?>">                
                <?php } ?>  
                    <!-- <button class="label note" >  -->
                        <i class="fas fa-pen cursor-pointer note" title=""></i>
                    <!-- </button> -->
                    <!-- <i class="fas fa-check cursor-pointer off off-zalo" style="display: none;"></i> -->
                    <i class="fas fa-check cursor-pointer hide note-zalo" style="display: none;"></i>
                    <textarea class="form-control text-note" name="" id="" cols="10" rows="1" placeholder="Ghi chú" style="display: none"><?=$data->note_zalo ?></textarea>
            </td>
            <!-- <td>
                <button class = "btn btn-success">Lưu</button>
            </td> -->
        </tr>
       <?php } ?>
    </tbody>
    </table>
     <div class="form-group">
        <label for="" class="form-label">Chọn đơn vị:</label>
        <select name="unit" id="" class="form-select unit">
            <?php foreach($unit as $unit): ?>
            <option value="<?=$unit->unit_code?>"><?= $unit->name ?></option>
            <?php endforeach ?>
        </select>
        <button class="btn btn-primary mt-3 add-unit">Thêm</button>
     </div>
</div>
