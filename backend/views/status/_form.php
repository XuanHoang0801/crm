<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\color\ColorInput;

/** @var yii\web\View $this */
/** @var app\models\Status $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="status-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group field-status-color required has-error">
    <label class="control-label" for="status-color">Color</label>
    <input type="color" id="status-color" class="form-color" name="Status[color]" maxlength="255" aria-required="true" aria-invalid="true">

    <div class="help-block"></div>
    </div>

    <div class="form-group mt-3">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
