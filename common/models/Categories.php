<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $normalImage
 * @property integer $active
 * @property integer $in_main_page
 * @property integer $order
 *
 * @property Items[] $items
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'active', 'in_main_page', 'order'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 250],
            [['normalImage'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'name' => Yii::t('app', 'Name'),
            'normalImage' => Yii::t('app', 'Normal Image'),
            'active' => Yii::t('app', 'Active'),
            'in_main_page' => Yii::t('app', 'In Main Page'),
            'order' => Yii::t('app', 'Order'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Items::className(), ['category_id' => 'id']);
    }
}
