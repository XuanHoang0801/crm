<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Unit $model */

$this->title = Yii::t('app', 'Tạo đơn vị');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Units'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
