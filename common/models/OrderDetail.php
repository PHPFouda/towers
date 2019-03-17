<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_detail".
 *
 * @property integer $id
 * @property integer $quantity
 * @property double $price
 * @property double $purchPrice
 * @property integer $order_id
 * @property integer $item_id
 * @property double $profitPercent
 * @property double $tax
 * @property string $combination_info
 *
 * @property Orders $order
 * @property Items $item
 */
class OrderDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quantity', 'price', 'purchPrice', 'order_id', 'item_id', 'profitPercent', 'tax'], 'required'],
            [['quantity', 'order_id', 'item_id'], 'integer'],
            [['price', 'purchPrice', 'profitPercent', 'tax'], 'number'],
            [['combination_info'], 'string'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['order_id' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'price' => Yii::t('app', 'Price'),
            'purchPrice' => Yii::t('app', 'Purch Price'),
            'order_id' => Yii::t('app', 'Order ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'profitPercent' => Yii::t('app', 'Profit Percent'),
            'tax' => Yii::t('app', 'Tax'),
            'combination_info' => Yii::t('app', 'Combination Info'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::className(), ['id' => 'item_id']);
    }
}
