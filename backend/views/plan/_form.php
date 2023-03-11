<?php

use app\models\Staff;
use app\models\Unit;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;

/** @var yii\web\View $this */
/** @var app\models\Plan $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="plan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_id')->dropDownList(
        ArrayHelper::map(Staff::getStaff(), 'staff_code', 'name'),['prompt'=>'--Select Option--'])   
    ?>
     <?= $form->field($model, 'unit_id')->dropDownList(
        ArrayHelper::map(Unit::getUnit(), 'unit_code', 'name'),['prompt'=>'--Select Option--'])   
    ?>

    <?= $form->field($model, 'form')->dropDownList(Yii::$app->params['plan.form'])?>

    <?=
        $form->field($model, 'time_start')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => 'Enter start time ...'],
            'pluginOptions' => [
                'autoclose' => true
            ]
        ]);
    ?>

    <?=
        $form->field($model, 'time_end')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => 'Enter end time ...'],
            'pluginOptions' => [
                'autoclose' => true
            ]
        ]);
    ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'error')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'request')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fix')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success mt-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
