<?php

use app\models\Level;
use app\models\Project;
use app\models\Status;
use app\models\User;
use common\models\User as ModelsUser;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Request $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group field-detail required">
    <label class="control-label" for="detail">Chi tiết yêu cầu</label>
    <textarea id="detail" class="form-control" name="Request[detail]" rows="6" aria-required="true"></textarea>
    <script>CKEDITOR.replace('detail');// tham số là biến name của textarea</script>
    <div class="help-block"></div>
</div>

    <?= $form->field($model, 'deadline')->textInput() ?>

    <?= 
        $form->field($model, 'project_id')->dropDownList(
            ArrayHelper::map(Project::find()->asArray()->all(), 'id', 'name')
        ) 
    ?>

    <?= 
        $form->field($model, 'user_id')->dropDownList(
            ArrayHelper::map(ModelsUser::find()->asArray()->all(), 'id', 'username')
        ) 
    ?>

    <?= 
        $form->field($model, 'status_id')->dropDownList(
            ArrayHelper::map(Status::find()->asArray()->all(), 'id', 'name')
        ) 
    ?>

    <?= 
        $form->field($model, 'level_id')->dropDownList(
            ArrayHelper::map(Level::find()->asArray()->all(), 'id', 'name')
        ) 
    ?>

    <?= $form->field($model, 'image')->fileInput(['class' => 'form-control']) ?>


    <div class="form-group mt-3">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
