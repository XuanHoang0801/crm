<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Transaction $model */

$this->title = Yii::t('app', 'Tạo giao dịch');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Giao dịch'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
