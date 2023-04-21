<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'lib/owlcarousel/assets/owl.carousel.min.css',
        // 'lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css',
        // 'css/fon',
        'css/bootstrap.min.css',
        'css/style.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css',
    ];
    public $js = [
        // 'lib/chart/chart.min.js',
        // 'lib/easing/easing.min.js',
        // 'lib/waypoints/waypoints.min.js',
        // 'lib/owlcarousel/owl.carousel.min.js',
        // 'lib/tempusdominus/js/moment.min.js',
        // 'lib/tempusdominus/js/moment-timezone.min.js',
        // 'lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js',
        'js/main.js',
        // 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js',
        // 'https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js',
        // 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js',
        // 'https://code.jquery.com/jquery-3.6.3.js',
        'js/ckeditor/ckeditor.js',
        'js/language.js',
        // 'js/delete_unit.js',
        // 'js/check_box.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
