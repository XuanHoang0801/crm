<?php

/**
* Created by PhpStorm.
* User: cuongtt11
* Date: 10/15/2020
* Time: 6:57 PM
*/

namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model {

    public $file_path;
    public $package_name;
    public static $listPackage = [
    'TV360_BASIC_BOX' => 'TV360_BASIC_BOX',
    'TV360_STANDARD_BOX' => 'TV360_STANDARD_BOX'
    ];

    public function rules() {
        $maxFileSize = 50 * 1024 * 1024; // 50 MB
        return [
        [['file_path'], 'file', 'skipOnEmpty' => false, 'extensions' => ['xls', 'xlsx'], 'maxSize' => $maxFileSize],
        [['package_name'], 'safe'],
        ];
    }

    public function saveFile($path) {
        if ($this->validate()) {
        UploadedFile::getInstance($this, 'file_path')->saveAs($path);
        return true;
        } else {
        return false;
        }
    }

}
