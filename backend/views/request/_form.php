<?php

use app\models\User;
use app\models\Level;
use yii\helpers\Html;
use app\models\Status;
use app\models\Project;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;
use backend\assets\AppAsset;
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;
use kartik\datetime\DateTimePicker;

/** @var yii\web\View $this */
/** @var app\models\Request $model */
/** @var yii\widgets\ActiveForm $form */
AppAsset::register($this);
?>
<div class="request-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detail')->widget(CKEditor::className(), [
		'options' => ['rows' => 6],
		'preset' => 'basic'
	]) ?>

    <?= $form->field($model, 'deadline')->textInput() ?>
    <?= $form->field($model, 'user_id')->dropDownList(
            ArrayHelper::map(User::find()->asArray()->all(), 'id', 'username')
        )  ?>

    <?= $form->field($model, 'project_id')->dropDownList(
            ArrayHelper::map(Project::find()->asArray()->all(), 'id', 'name')
        )  ?>

    <?= $form->field($model, 'status_id')->dropDownList(
            ArrayHelper::map(Status::find()->asArray()->all(), 'id', 'name')
        ) ?>

    <?= $form->field($model, 'level_id')->dropDownList(
            ArrayHelper::map(Level::find()->asArray()->all(), 'id', 'name')
        )  ?>
    <?=
        $form->field($model, 'time_start')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => 'Enter event time ...'],
            'pluginOptions' => [
                'autoclose' => true
            ]
        ]);
    ?>

    <?=
        $form->field($model, 'time_end')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => 'Enter event time ...'],
            'pluginOptions' => [
                'autoclose' => true
            ]
        ]);
    ?>

    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*'],
]); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Lưu' : 'Cập nhật',['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
