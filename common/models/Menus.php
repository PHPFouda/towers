<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent
 * @property string $route
 * @property integer $order
 * @property resource $data
 * @property integer $active
 * @property integer $is_backend
 * @property string $created
 *
 * @property Menus $parent0
 * @property Menus[] $menuses
 * @property MenuTranslations[] $menuTranslations
 */
class Menus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent', 'order', 'active', 'is_backend'], 'integer'],
            [['data'], 'string'],
            [['created'], 'safe'],
            [['name'], 'string', 'max' => 128],
            [['route'], 'string', 'max' => 255],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => Menus::className(), 'targetAttribute' => ['parent' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'parent' => Yii::t('app', 'Parent'),
            'route' => Yii::t('app', 'Route'),
            'order' => Yii::t('app', 'Order'),
            'data' => Yii::t('app', 'Data'),
            'active' => Yii::t('app', 'Active'),
            'is_backend' => Yii::t('app', 'Is Backend'),
            'created' => Yii::t('app', 'Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Menus::className(), ['id' => 'parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuses()
    {
        return $this->hasMany(Menus::className(), ['parent' => 'id']);
    }

        /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenusTranslations()
    {
        $query = $this->hasOne(MenusTranslations::className(), ['menu_id' => 'id']);
        $query->andOnCondition('`language_alias` = :language', [':language'=>Yii::$app->language]);
        return $query;
    }

     /** 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getMenusTranslationsAll() 
    { 
        return $this->hasMany(MenusTranslations::className(), ['menu_id' => 'id']); 
    }

}
