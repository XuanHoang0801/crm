<?php

use app\models\BelongUnit;
use yii\helpers\Html;
use app\models\Province;
use app\models\TypeCustomer;
use app\models\TypeUnit;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Unit $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="unit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'unit_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_unit_id')->dropDownList(
        ArrayHelper::map(TypeUnit::getTypeUnit(), 'type_unit_code', 'name'))   
    ?>

    <?= $form->field($model, 'belong_unit_id')->dropDownList(
        ArrayHelper::map(BelongUnit::getBelongUnit(), 'belong_code', 'name'))   
    ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_customer_id')->dropDownList(
        ArrayHelper::map(TypeCustomer::getTypeCustomer(), 'id', 'name'))   
    ?>

    <?= $form->field($model, 'status')->dropDownList([
         0 => 'Dùng thử',
         1 => 'Đang hoạt động',
         2 => 'Không hoạt động',
         3 => 'Hểt hạn'
    ]) ?>

    <?= $form->field($model, 'province_id')->dropDownList(
        ArrayHelper::map(Province::getProvince(), 'province_code', 'name'))   
    ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success mt-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
