<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "package".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $detail
 */
class Package extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'package';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['detail'], 'string'],
            [['code', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Mã gói cước'),
            'name' => Yii::t('app', 'Tên gói cước'),
            'detail' => Yii::t('app', 'Chính sách chi tiết'),
        ];
    }

    public static function getPackage()
    {
        return Package::find()->all();
    }
}
