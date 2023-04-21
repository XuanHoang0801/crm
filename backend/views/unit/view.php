<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Unit $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Units'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="unit-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'unit_code',
            'name',
            'type.name',
            'belong.name',
            'customer.name',
            'province.name',
            'link',
            [
                'label' => Yii::t('app','Trạng thái'),
                'value' => function($model){
                    if($model->status  == 0){
                        return Yii::t('app','Dùng thử');
                    }
                    if($model->status  == 1){
                        return Yii::t('app','Đang hoạt động');
                    }
                    if($model->status  == 2){
                        return Yii::t('app','Không hoạt động');
                    }
                    if($model->status  == 3){
                        return Yii::t('app','Hết hạn');
                    }

                }
            ],

        ],
    ]) ?>

</div>
