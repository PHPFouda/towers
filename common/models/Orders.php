<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $order_status
 * @property integer $shippingservice_id
 * @property double $subtotal
 * @property double $shipping
 * @property double $tax
 * @property double $total
 * @property double $paid
 * @property double $due
 * @property string $created
 * @property string $additional_info
 * @property double $additional_fees
 * @property string $cancel_reason
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'order_status', 'subtotal', 'shipping', 'tax', 'total', 'paid', 'due', 'additional_fees'], 'required'],
            [['user_id', 'order_status', 'shippingservice_id'], 'integer'],
            [['subtotal', 'shipping', 'tax', 'total', 'paid', 'due', 'additional_fees'], 'number'],
            [['created'], 'safe'],
            [['additional_info', 'cancel_reason'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'order_status' => Yii::t('app', 'Order Status'),
            'shippingservice_id' => Yii::t('app', 'Shippingservice ID'),
            'subtotal' => Yii::t('app', 'Subtotal'),
            'shipping' => Yii::t('app', 'Shipping'),
            'tax' => Yii::t('app', 'Tax'),
            'total' => Yii::t('app', 'Total'),
            'paid' => Yii::t('app', 'Paid'),
            'due' => Yii::t('app', 'Due'),
            'created' => Yii::t('app', 'Created'),
            'additional_info' => Yii::t('app', 'Additional Info'),
            'additional_fees' => Yii::t('app', 'Additional Fees'),
            'cancel_reason' => Yii::t('app', 'Cancel Reason'),
        ];
    }
}
