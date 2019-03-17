<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Items;

/**
 * ItemsSearch represents the model behind the search form about `common\models\Items`.
 */
class ItemsSearch extends Items
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'quantity', 'sale_count', 'freeShipping', 'max_amount_in_order', 'isFeatured', 'active', 'inStock', 'order'], 'integer'],
            [['title', 'description', 'barcode', 'imageUrl', 'created', 'last_update'], 'safe'],
            [['profitPercent', 'purchPrice', 'weight', 'price', 'price_old', 'tax'], 'number'],
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
        $query = Items::find();

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
            'category_id' => $this->category_id,
            'quantity' => $this->quantity,
            'sale_count' => $this->sale_count,
            'profitPercent' => $this->profitPercent,
            'purchPrice' => $this->purchPrice,
            'weight' => $this->weight,
            'freeShipping' => $this->freeShipping,
            'max_amount_in_order' => $this->max_amount_in_order,
            'isFeatured' => $this->isFeatured,
            'active' => $this->active,
            'inStock' => $this->inStock,
            'price' => $this->price,
            'price_old' => $this->price_old,
            'tax' => $this->tax,
            'created' => $this->created,
            'order' => $this->order,
            'last_update' => $this->last_update,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'barcode', $this->barcode])
            ->andFilterWhere(['like', 'imageUrl', $this->imageUrl]);

        return $dataProvider;
    }
}
