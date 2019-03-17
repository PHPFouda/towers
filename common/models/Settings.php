<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property integer $id
 * @property string $alias
 * @property string $setting_key
 * @property string $setting_value
 * @property string $title
 * @property integer $is_editable
 * @property string $description
 * @property string $created
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias', 'setting_key', 'setting_value'], 'required'],
            [['is_editable'], 'integer'],
            [['created'], 'safe'],
            [['alias', 'setting_key', 'title'], 'string', 'max' => 100],
            [['setting_value', 'description'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'alias' => Yii::t('app', 'Alias'),
            'setting_key' => Yii::t('app', 'Setting Key'),
            'setting_value' => Yii::t('app', 'Setting Value'),
            'title' => Yii::t('app', 'Title'),
            'is_editable' => Yii::t('app', 'Is Editable'),
            'description' => Yii::t('app', 'Description'),
            'created' => Yii::t('app', 'Created'),
        ];
    }
}
