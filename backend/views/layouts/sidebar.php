<?php
use app\models\Menu;
use yii\helpers\Url;
use yii\bootstrap5\Nav;
use yii\bootstrap5\Html;
use yii\bootstrap5\NavBar;
 ?>
<div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="<?= Url::toRoute('/') ?>" class="navbar-brand mx-4 mb-3 text-center">
                    <?= Html::img('@web/img/logo.png',['width'=>50, 'height' => 30]) ?>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <?=Html::img(Url::to('@web/uploads/'.Yii::$app->user->identity->avatar.'', true),[ 'class' => 'rounded-circle']) ?>                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">  <?=  Yii::$app->user->identity->fullname?></h6>
                        <span>  <?=  Yii::$app->user->identity->username?></span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="<?= Url::toRoute('/') ?>" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">

                        <a href="#" class="nav-link" >
                            <i class="fa fa-laptop me-2"></i>
                            Quản trị
                        </a>
                        <div class=" bg-transparent border-0">   
                        <?php
                            $url = Yii::$app->request->url;
                            $urlCheck = Url::base();    
                            foreach(Menu::getDashboard()as $dashboarh){
                                if($url == $urlCheck.$dashboarh->route){
                        ?>
                            <a href="<?= Url::toRoute($dashboarh->route,true)?>" class="dropdown-item active"><?= Yii::t('app',$dashboarh->name) ?></a>
                        <?php }else{ ?>
                            <a href="<?= Url::toRoute($dashboarh->route,true)?>" class="dropdown-item"><?= Yii::t('app',$dashboarh->name) ?></a>

                        <?php }} ?>
                        </div>
                    </div>                 
                    <?php
                        foreach(Menu::getMenuParent()as $parent){
                    ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <?= $parent->icon ?>
                            <?= Yii::t('app',$parent->name) ?>
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <?php
                                foreach(Menu::getMenuItem($parent->id) as $menuItem){
                            ?>
                            <a href="<?= Url::toRoute($menuItem->route,true)?>" class="dropdown-item"><?= Yii::t('app',$menuItem->name) ?></a>
                            <?php } ?>

                        </div>
                    </div>
                    <?php } ?>

                </div>
        </div>