<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Đổi mật khẩu';
?>

                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                        <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex align-items-center justify-content-center mb-3">
                                <h3>Đổi mật khẩu</h3>
                            </div>

                                <?php $form = ActiveForm::begin(['id' => 'change-form']); ?>

                                    <?= $form->field($model, 'password_old')->passwordInput()->label(Yii::t('app', 'Mật khẩu hiện tại'))?>

                                    <?= $form->field($model, 'password_new')->passwordInput()->label(Yii::t('app', 'Mật khẩu mới'))?>

                                    <?= $form->field($model, 're_password')->passwordInput()->label(Yii::t('app', 'Xác thực mật khẩu')) ?>
                                    
                                    <div class="form-group">
                                        <?= Html::submitButton('Đổi mật khẩu', ['class' => 'btn btn-success btn-block', 'name' => 'change-button']) ?>
                                    </div>

                                <?php ActiveForm::end(); ?>
                                </div>
                    </div>
