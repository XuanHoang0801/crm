<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Level $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="level-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group field-level-color required has-error">
    <label class="control-label" for="level-color">Color</label>
    <input type="color" id="level-color" class="form-color" name="Level[color]" maxlength="255" aria-required="true" aria-invalid="true">

    <div class="help-block"></div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
