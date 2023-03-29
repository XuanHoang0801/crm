<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "action_log".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $data_before
 * @property string|null $data_after
 * @property string|null $url
 * @property int|null $content_id
 * @property string|null $created_at
 */
class ActionLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'action_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'content_id'], 'integer'],
            [['data_before', 'data_after','url'], 'string'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'url' => Yii::t('app', 'Url'),
            'data_before' => Yii::t('app', 'Data Before'),
            'data_after' => Yii::t('app', 'Data After'),
            'content_id' => Yii::t('app', 'Content ID'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
