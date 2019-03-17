<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "menu_translations".
 *
 * @property integer $id
 * @property integer $menu_id
 * @property string $language_alias
 * @property string $name
 *
 * @property Menu $menu
 */
class MenusTranslations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu_translations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_id', 'language_alias', 'name'], 'required'],
            [['menu_id'], 'integer'],
            [['language_alias', 'name'], 'string', 'max' => 45],
            [['menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menus::className(), 'targetAttribute' => ['menu_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'menu_id' => Yii::t('app', 'Menu ID'),
            'language_alias' => Yii::t('app', 'Language Alias'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(Menus::className(), ['id' => 'menu_id']);
    }
}
