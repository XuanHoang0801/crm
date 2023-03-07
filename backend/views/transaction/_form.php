<?php

use app\models\Package;
use app\models\Unit;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;

/** @var yii\web\View $this */
/** @var app\models\Transaction $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="transaction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit_id')->dropDownList(
        ArrayHelper::map(Unit::getUnit(), 'unit_code', 'name'),['prompt'=>'--Select Option--'])   
    ?>

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

<?= $form->field($model, 'package_id')->dropDownList(
        ArrayHelper::map(Package::getPackage(), 'code', 'name'),['prompt'=>'--Select Option--'])   
    ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList(
        [
            0 => 'Chưa giao dịch',
            1 => 'Đã giao dịch',
            2 => 'Giao dịch thành công',

        ]) 
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success mt-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
