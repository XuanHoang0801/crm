<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Package $model */

$this->title = Yii::t('app', 'Tạo gói cước');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gói cước'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="package-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
