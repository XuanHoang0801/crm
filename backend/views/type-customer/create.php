<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TypeCustomer $model */

$this->title = Yii::t('app', 'Create Type Customer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Type Customers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-customer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
