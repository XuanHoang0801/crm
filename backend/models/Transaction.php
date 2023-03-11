<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property int $id
 * @property string $code
 * @property string $unit_id
 * @property string|null $time_start
 * @property string|null $time_end
 * @property string|null $package_id
 * @property int|null $total
 * @property int|null $status
 */
class Transaction extends \yii\db\ActiveRecord
{
    // const CHUAGIAODICH = 0;
    // const DAGIAODICH = 1;
    // const THANHCONG = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'unit_id'], 'required'],
            [['time_start', 'time_end'], 'safe'],
            [['total', 'status'], 'integer'],
            [['code', 'unit_id', 'package_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Mã giao dịch'),
            'unit_id' => Yii::t('app', 'Mã đơn vị'),
            'time_start' => Yii::t('app', 'Thời gian bắt đầu'),
            'time_end' => Yii::t('app', 'Thời gian kết thúc'),
            'package_id' => Yii::t('app', 'Gói cước'),
            'total' => Yii::t('app', 'Thành tiền'),
            'status' => Yii::t('app', 'Trạng thái'),
        ];
    }
    public static function getStatus()
    {
        return [
            0 => 'Chưa giao dịch',
            1 => 'Đã giao dịch',
            2 => 'Giao dịch thành công',
        ];
    }
}
