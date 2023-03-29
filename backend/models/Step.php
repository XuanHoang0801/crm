<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "step".
 *
 * @property int $id
 * @property string $unit_id
 *  @property bool|null $intro
 * @property bool|null $zalo
 * @property string|null $note_intro
 * @property string|null $note_zalo
 *
 * @property Unit $unit
 */
class Step extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'step';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unit_id'], 'required'],
            [['intro', 'zalo'], 'boolean'],
            [['note_intro', 'note_zalo'], 'string'],
            [['unit_id'], 'string', 'max' => 255],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::class, 'targetAttribute' => ['unit_id' => 'unit_code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'unit_id' => Yii::t('app', 'Unit ID'),
            'intro' => Yii::t('app', 'Intro'),
            'zalo' => Yii::t('app', 'Zalo'),
            'note_intro' => Yii::t('app', 'Note Intro'),
            'note_zalo' => Yii::t('app', 'Note Zalo'),
        ];
    }

    /**
     * Gets query for [[Unit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Unit::class, ['unit_code' => 'unit_id']);
    }
}
