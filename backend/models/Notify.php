<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "notify".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $slug
 * @property int|null $task_id
 * @property int|null $user_id
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Notify extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notify';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'user_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'slug'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'slug' => Yii::t('app', 'Slug'),
            'task_id' => Yii::t('app', 'Task ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public static function getNotify()
    {
        $user_id = Yii::$app->user->identity->id;
        $query = Notify::find()->where(['user_id' => $user_id ])->all();
        return $query;
    }
    public static function getCount()
    {
        $user_id = Yii::$app->user->identity->id;
        $query = Notify::find()->where(['user_id' => $user_id ])->andWhere(['status' => 0])->all();
        return $query;
    }
}
