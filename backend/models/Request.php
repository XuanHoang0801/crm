<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property string $name
 * @property string $detail
 * @property int $deadline
 * @property int $project_id
 * @property int $user_id
 * @property int $status_id
 * @property int $level_id
 * @property string|null $image
 * @property string $created_at
 * @property string $updated_at
 * @property string|null $deleted_at
 * @property string|null $time_start
 * @property string|null $time_end
 *
 * @property Level $level
 * @property Project $project
 * @property Status $status
 * @property User $user
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'detail', 'deadline', 'project_id', 'user_id', 'status_id', 'level_id','time_start','time_end'], 'required'],
            [['detail'], 'string'],
            [['deadline', 'project_id', 'user_id', 'status_id', 'level_id'], 'integer'],
            [['time_start', 'time_end'], 'safe'],
            [['name', 'image'], 'string', 'max' => 255],
            [['level_id'], 'exist', 'skipOnError' => true, 'targetClass' => Level::class, 'targetAttribute' => ['level_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::class, 'targetAttribute' => ['project_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
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
            'name' => Yii::t('app', 'Tên yêu cầu'),
            'detail' => Yii::t('app', 'Chi tiết yêu cầu'),
            'deadline' => Yii::t('app', 'Tiến độ'),
            'project_id' => Yii::t('app', 'Dự án'),
            'user_id' => Yii::t('app', 'Người phụ trách'),
            'status_id' => Yii::t('app', 'Trạng thái'),
            'level_id' => Yii::t('app', 'Cấp độ'),
            'image' => Yii::t('app', 'Hình ảnh'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'time_start' => Yii::t('app', 'Bắt đầu'),
            'time_end' => Yii::t('app', 'Kết thúc'),
        ];
    }

    /**
     * Gets query for [[Level]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLevel()
    {
        return $this->hasOne(Level::class, ['id' => 'level_id']);
    }

    /**
     * Gets query for [[Project]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::class, ['id' => 'project_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
