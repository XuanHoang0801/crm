<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "belong_unit".
 *
 * @property int $id
 * @property string $name
 * @property string $belong_code
 * @property string $province_id
 */
class BelongUnit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'belong_unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'belong_code', 'province_id'], 'required'],
            [['name', 'belong_code', 'province_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Đơn vị trực thuộc'),
            'belong_code' => Yii::t('app', 'Mã đơn vị'),
            'province_id' => Yii::t('app', 'Mã tỉnh'),
        ];
    }
    public static function getBelongUnit()
    {
        return BelongUnit::find()->all();
    }
}
