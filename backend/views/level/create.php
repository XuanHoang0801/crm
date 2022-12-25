<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Level $model */

$this->title = 'Tạo cấp độ mới';
$this->params['breadcrumbs'][] = ['label' => 'Cấp độ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="level-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
