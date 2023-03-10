<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Province $model */

$this->title = Yii::t('app', 'Create Province');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Provinces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="province-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
