<?php

namespace app\models;

use Yii;
use app\models\TypeUnit;

/**
 * This is the model class for table "unit".
 *
 * @property int $id
 * @property string $name
 * @property string $type_unit_id
 * @property string $belong_unit_id
 * @property string|null $link
 * @property string|null $type_customer_id
 * @property int|null $status
 * @property string $province_id
 * @property string $unit_code
 */
class Unit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type_unit_id', 'belong_unit_id', 'province_id', 'unit_code'], 'required'],
            [['status'], 'integer'],
            [['name', 'type_unit_id', 'belong_unit_id', 'link', 'type_customer_id', 'province_id', 'unit_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Tên đơn vị'),
            'type_unit_id' => Yii::t('app', 'Loại đơn vị'),
            'belong_unit_id' => Yii::t('app', 'Đơn vị trực thuộc'),
            'link' => Yii::t('app', 'Link'),
            'type_customer_id' => Yii::t('app', 'Loại khách hàng'),
            'status' => Yii::t('app', 'Trạng thái'),
            'province_id' => Yii::t('app', 'Mã tỉnh'),
            'unit_code' => Yii::t('app', 'Mã đơn vị'),
        ];
    }

   
    public function getType()
    {
        return $this->hasOne(TypeUnit::className(),['type_unit_code' => 'type_unit_id']);
    }
    public function getBelong()
    {
        return $this->hasOne(BelongUnit::className(),['belong_code' => 'belong_unit_id']);
    }
    public function getCustomer()
    {
        return $this->hasOne(TypeCustomer::className(),['id' => 'type_customer_id']);
    }
    public static function getUnit()
    {
        return Unit::find()->all();
    }
    
}
