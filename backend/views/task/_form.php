<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Task $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>
    <form class="row g-3">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <div class="row">
        <div class="form-group col-md-4">
                <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group col-md-2">
                <?= $form->field($model, 'database')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group col-md-2">
                <?= $form->field($model, 'table')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

    <?php // echo $form->field($model, 'status')->textInput() ?>
    <?= $form->field($model, 'status')->dropDownList([0 => Yii::t('app','ĐANG THỰC HIỆN'), 1 => Yii::t('app','HOÀN THÀNH') ],['class'=> 'form-select'])  ?> 

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'image')->fileInput(['class' => 'form-control']) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success mt-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
