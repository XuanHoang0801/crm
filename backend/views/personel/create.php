<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Personel $model */

$this->title = Yii::t('app', 'Create Personel');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Personels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
