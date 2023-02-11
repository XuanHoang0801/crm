<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property string $name
 * @property int|null $parent
 * @property string $route
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $type
 * @property string|null $icon
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent', 'type'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'route', 'icon'], 'string', 'max' => 255],
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
            'name' => Yii::t('app', 'Name'),
            'parent' => Yii::t('app', 'Parent'),
            'route' => Yii::t('app', 'Route'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'type' => Yii::t('app', 'Type'),
            'icon' => Yii::t('app', 'Icon'),
        ];
    }

    public static function getDashboard()
    {
        $dashoard = Menu::find()->where('parent = 1')->all();
        return $dashoard;
    }
    public static function getMenuItem()
    {
        $menuItem = Menu::find()->where('parent = 4')->all();
        return $menuItem;
    }
    public static function getConfig()
    {
        $config = Menu::find()->where('parent = 9')->all();
        return $config;
    }


}
