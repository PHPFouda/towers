<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "languages".
 *
 * @property string $alias
 * @property string $title
 * @property string $image
 * @property integer $active
 * @property integer $is_main
 * @property integer $active_admin
 * @property integer $is_main_admin
 * @property string $created
 */
class Languages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'languages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias'], 'required'],
            [['active', 'is_main', 'active_admin', 'is_main_admin'], 'integer'],
            [['created'], 'safe'],
            [['alias', 'title'], 'string', 'max' => 45],
            [['image'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'alias' => Yii::t('app', 'Alias'),
            'title' => Yii::t('app', 'Title'),
            'image' => Yii::t('app', 'Image'),
            'active' => Yii::t('app', 'Active'),
            'is_main' => Yii::t('app', 'Is Main'),
            'active_admin' => Yii::t('app', 'Active Admin'),
            'is_main_admin' => Yii::t('app', 'Is Main Admin'),
            'created' => Yii::t('app', 'Created'),
        ];
    }
}
