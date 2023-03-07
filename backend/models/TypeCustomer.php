<?php

namespace app\models;

use backend\models\TypeCustomerSearch;
use Yii;

/**
 * This is the model class for table "type_customer".
 *
 * @property int $id
 * @property string $name
 */
class TypeCustomer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'type_customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    public static function getTypeCustomer()
    {
        return TypeCustomer::find()->all();
    }
}
