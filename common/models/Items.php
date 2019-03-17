<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "items".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $category_id
 * @property string $barcode
 * @property string $imageUrl
 * @property int $quantity
 * @property int $sale_count
 * @property double $profitPercent
 * @property double $purchPrice
 * @property double $weight
 * @property int $freeShipping
 * @property int $max_amount_in_order
 * @property int $isFeatured
 * @property int $active
 * @property int $inStock
 * @property double $price
 * @property double $price_old
 * @property double $tax
 * @property string $created
 * @property int $order
 * @property string $last_update
 *
 * @property Categories $category
 * @property OrderDetail[] $orderDetails
 */
class Items extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'category_id', 'imageUrl', 'quantity', 'sale_count', 'purchPrice', 'weight', 'active', 'inStock', 'price', 'order'], 'required'],
            [['category_id', 'quantity', 'sale_count', 'freeShipping', 'max_amount_in_order', 'isFeatured', 'active', 'inStock', 'order'], 'integer'],
            [['profitPercent', 'purchPrice', 'weight', 'price', 'price_old', 'tax'], 'number'],
            [['created', 'last_update'], 'safe'],
            [['title', 'barcode', 'imageUrl'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 300],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'category_id' => Yii::t('app', 'Category ID'),
            'barcode' => Yii::t('app', 'Barcode'),
            'imageUrl' => Yii::t('app', 'Image Url'),
            'quantity' => Yii::t('app', 'Quantity'),
            'sale_count' => Yii::t('app', 'Sale Count'),
            'profitPercent' => Yii::t('app', 'Profit Percent'),
            'purchPrice' => Yii::t('app', 'Purch Price'),
            'weight' => Yii::t('app', 'Weight'),
            'freeShipping' => Yii::t('app', 'Free Shipping'),
            'max_amount_in_order' => Yii::t('app', 'Max Amount In Order'),
            'isFeatured' => Yii::t('app', 'Is Featured'),
            'active' => Yii::t('app', 'Active'),
            'inStock' => Yii::t('app', 'In Stock'),
            'price' => Yii::t('app', 'Price'),
            'price_old' => Yii::t('app', 'Price Old'),
            'tax' => Yii::t('app', 'Tax'),
            'created' => Yii::t('app', 'Created'),
            'order' => Yii::t('app', 'Order'),
            'last_update' => Yii::t('app', 'Last Update'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderDetails()
    {
        return $this->hasMany(OrderDetail::className(), ['item_id' => 'id']);
    }
}
