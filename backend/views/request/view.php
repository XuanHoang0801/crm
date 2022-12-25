<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Request $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Yêu cầu'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="request-view">

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
            'id',
            'name',
            'detail:ntext',
            'deadline',
            [
                'attribute' => 'Dự án',
                'value'     => $model->project->name,
            ],
            [
                'attribute' => 'Phụ trách',
                'value'     => $model->user->username,
            ],
            [
                'attribute' => 'Cấp độ',
                'value'     => $model->level->name,
            ],
            [
                'attribute' => 'Trạng thái',
                'value'     => $model->status->name,
            ],
          
            'image',
            [
                'attribute' => 'Ngày tạo',
                'value'     =>$model->created_at
            ],
        ],
    ]) ?>

</div>
