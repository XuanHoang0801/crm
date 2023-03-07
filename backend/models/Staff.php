<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staff".
 *
 * @property int $id
 * @property string $name
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $province_id
 * @property string $staff_code
 */
class Staff extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staff';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'staff_code'], 'required'],
            [['name', 'phone', 'email', 'province_id', 'staff_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Họ Tên'),
            'phone' => Yii::t('app', 'Điện thoại'),
            'email' => Yii::t('app', 'Email'),
            'province_id' => Yii::t('app', 'Mã tỉnh'),
            'staff_code' => Yii::t('app', 'Mã nhân viên'),
        ];
    }

    public static function getStaff()
    {
        return Staff::find()->all();
    }
}
