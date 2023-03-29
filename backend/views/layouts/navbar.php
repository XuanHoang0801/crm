<?php

use app\models\Notify;
use yii\helpers\Url;
use yii\bootstrap5\Html;

?>
<div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                   
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <?php 
                                if(count(Notify::getCount()) != 0){
                            ?>
                            <span class="position-absolute top start translate-middle badge rounded-pill bg-danger"> <?= count(Notify::getCount()) ?></span>
                            <?php } ?>
                            <span class="d-none d-lg-inline-flex"><?= Yii::t('app','Thông báo')?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <?php 
                                if(count(Notify::getCount()) == 0){
                            ?>
                        <span  class="dropdown-item text-center text-primary"><?= Yii::t('app','Không có thông báo mới!') ?></span>

                            <?php } else{ }
                                foreach (Notify::getNotify() as $notify){
                            ?>
                                <a href="<?= Url::toRoute('task/view?id='.$notify->task_id) ?>" class="dropdown-item <?php if($notify->status == 0){echo "active";} ?>">
                                    <h6 class="fw-normal mb-0"><?= $notify->title ?></h6>
                                    <small><?= $notify->created_at ?></small>
                                </a>
                                <hr class="dropdown-divider">
                           <?php } ?>
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <!-- <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;"> -->
                            <?=Html::img(Url::to('@web/uploads/'.Yii::$app->user->identity->avatar.'', true),[ 'class' => 'rounded-circle']) ?>
                            <span class="d-none d-lg-inline-flex">
                                <?=  Yii::$app->user->identity->username?>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="<?= Url::toRoute('/user/change-password?id='.Yii::$app->user->identity->id) ?>" class="dropdown-item"><?= Yii::t('app',  'Đổi mật khẩu') ?> </a>
                            <?php
                                echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
                                . Html::submitButton(
                                    'Logout',
                                    ['class' => 'btn btn-link logout text-decoration-none']
                                )
                                . Html::endForm();
                            ?>
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <?php
                                $lang =  Yii::$app->language;
                                if($lang == 'vi'){
                            ?>
                                <span class="d-none d-lg-inline-flex"> <?= Html::img('@web/img/vi.png',['width' => 20, 'height' => 20, 'style' => 'object-fit: contain;']) ?></span>
                            <?php }  else{?>
                                <span class="d-none d-lg-inline-flex"> <?= Html::img('@web/img/en.png',['width' => 20, 'height' => 20, 'style' => 'object-fit: contain;']) ?></span>

                            <?php } ?>

                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <span class="dropdown-item language" id="vi">
                                <?= Html::img('@web/img/vi.png',['width' => 20, 'height' => 20, 'style' => 'object-fit: contain;']) ?>
                                <?= Yii::t('app','Tiếng Việt') ?>
                            </span>
                            <span class="dropdown-item language" id="en">
                                <?= Html::img('@web/img/en.png',['width' => 20, 'height' => 20, 'style' => 'object-fit: contain;']) ?>

                                <?= Yii::t('app','Tiếng Anh') ?>
                            </span>
                           
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
            <div class="mt-3">