<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Plan $model */

$this->title = Yii::t('app', 'Tạo kế hoạch');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kế hoạch'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
