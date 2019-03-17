<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OrderDetail;

/**
 * OrderDetailSearch represents the model behind the search form about `common\models\OrderDetail`.
 */
class OrderDetailSearch extends OrderDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'quantity', 'order_id', 'item_id'], 'integer'],
            [['price', 'purchPrice', 'profitPercent', 'tax'], 'number'],
            [['combination_info'], 'safe'],
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
        $query = OrderDetail::find();

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
            'quantity' => $this->quantity,
            'price' => $this->price,
            'purchPrice' => $this->purchPrice,
            'order_id' => $this->order_id,
            'item_id' => $this->item_id,
            'profitPercent' => $this->profitPercent,
            'tax' => $this->tax,
        ]);

        $query->andFilterWhere(['like', 'combination_info', $this->combination_info]);

        return $dataProvider;
    }
}
