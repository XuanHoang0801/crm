<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Step $model */

$this->title = Yii::t('app', 'Create Step');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Steps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="step-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
