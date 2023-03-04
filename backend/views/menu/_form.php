<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Menu $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent')->textInput() ?>

    <?= $form->field($model, 'route')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'active')->checkBox(['class' => 'control-check mt-3']) ?>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success mt-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
