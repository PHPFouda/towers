<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Orders;

/**
 * OrdersSearch represents the model behind the search form about `common\models\Orders`.
 */
class OrdersSearch extends Orders
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'order_status', 'shippingservice_id'], 'integer'],
            [['subtotal', 'shipping', 'tax', 'total', 'paid', 'due', 'additional_fees'], 'number'],
            [['created', 'additional_info', 'cancel_reason'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Orders::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'order_status' => $this->order_status,
            'shippingservice_id' => $this->shippingservice_id,
            'subtotal' => $this->subtotal,
            'shipping' => $this->shipping,
            'tax' => $this->tax,
            'total' => $this->total,
            'paid' => $this->paid,
            'due' => $this->due,
            'created' => $this->created,
            'additional_fees' => $this->additional_fees,
        ]);

        $query->andFilterWhere(['like', 'additional_info', $this->additional_info])
            ->andFilterWhere(['like', 'cancel_reason', $this->cancel_reason]);

        return $dataProvider;
    }
}
