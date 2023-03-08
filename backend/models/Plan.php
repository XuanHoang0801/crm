<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "plan".
 *
 * @property int $id
 * @property string $name
 * @property string|null $customer_id
 * @property int|null $form
 * @property string|null $time_start
 * @property string|null $time_end
 * @property string|null $unit_id
 * @property string|null $content
 * @property string|null $error
 * @property string|null $request
 * @property string|null $fix
 */
class Plan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','unit_id','customer_id'], 'required'],
            [['form'], 'integer'],
            [['time_start', 'time_end'], 'safe'],
            [['content', 'error', 'fix'], 'string'],
            [['name', 'customer_id', 'unit_id', 'request'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'customer_id' => Yii::t('app', 'Mã nhân viên'),
            'form' => Yii::t('app', 'Hình thức'),
            'time_start' => Yii::t('app', 'Thời gian bắt đầu'),
            'time_end' => Yii::t('app', 'Thời gian kết thúc'),
            'unit_id' => Yii::t('app', 'Mã đơn vị'),
            'content' => Yii::t('app', 'Nội dung'),
            'error' => Yii::t('app', 'Lỗi'),
            'request' => Yii::t('app', 'Đề xuất'),
            'fix' => Yii::t('app', 'Rút kinh nghiệm'),
        ];
    }
    public function getUnit()
    {
        return $this->hasOne(Unit::class,['unit_code'=> 'unit_id']);
    }
}
