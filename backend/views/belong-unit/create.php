<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\BelongUnit $model */

$this->title = Yii::t('app', 'Create Belong Unit');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Belong Units'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="belong-unit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
