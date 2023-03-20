<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\captcha\Captcha;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
?>
<div class="position-relative bg-white d-flex p-0">
  <div class="container-fluid">
                <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                        <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h3>Đăng nhập</h3>
                            </div>

                                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                                    <?= $form->field($model, 'password')->passwordInput() ?>

                                    <?= $form->field($model, 'captcha')->widget(Captcha::className(),
                                        ['template' => '<div class="captcha_img">{image}</div>'
                                        . '<a class="refreshcaptcha" href="#">'
                                        . Html::img('/images/imageName.png',[]).'</a>'
                                        . 'Captcha Code{input}',
                                    ])->label(FALSE); ?> 
                                    
                                    <?= $form->field($model, 'rememberMe')->checkbox() ?>


                                    <div class="form-group">
                                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                                    </div>

                                <?php ActiveForm::end(); ?>
                                </div>
                    </div>
                </div>
            </div>
            <!-- Sign In End -->
        </div>
