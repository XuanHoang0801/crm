<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "type_unit".
 *
 * @property int $id
 * @property string $name
 * @property string $type_unit_code
 */
class TypeUnit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'type_unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type_unit_code'], 'required'],
            [['name', 'type_unit_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Loại đơn vị'),
            'type_unit_code' => Yii::t('app', 'Mã loại đơn vị'),
        ];
    }

    public static function getTypeUnit()
    {
        return TypeUnit::find()->all();
    }
}
