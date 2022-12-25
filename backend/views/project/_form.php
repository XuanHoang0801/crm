<?php

use yii\helpers\Html;
use app\models\Categories;
use common\models\User;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Project $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deadline')->textInput() ?>

    <?= 
        $form->field($model, 'category_id')->dropDownList(
            ArrayHelper::map(Categories::find()->asArray()->all(), 'id', 'name')
        ) 
    ?>

    <?= 
        $form->field($model, 'user_id')->dropDownList(
            ArrayHelper::map(User::find()->asArray()->all(), 'id', 'username')
            ) 
    ?> 

    <?= $form->field($model, 'image')->fileInput(['class' => 'form-control']) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
