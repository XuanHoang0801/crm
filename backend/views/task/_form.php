<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Task $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'database')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'table')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'status')->textInput() ?>
    <?= $form->field($model, 'status')->dropDownList([0 => Yii::t('app','ĐANG THỰC HIỆN'), 1 => Yii::t('app','HOÀN THÀNH') ],['class'=> 'form-select'])  ?> 

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'image')->fileInput(['class' => 'form-control']) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success mt-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
