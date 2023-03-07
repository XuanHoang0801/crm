<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TypeUnit $model */

$this->title = Yii::t('app', 'Create Type Unit');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Type Units'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-unit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
