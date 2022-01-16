<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;

/**
 * OrderSearch represents the model behind the search form of `app\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'creator_id'], 'integer'],
            [['customer', 'contact','status','created_date'], 'safe'],
            [['area', 'real_price', 'discount', 'sell_price', 'deposit', 'balance'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Order::find();

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
            'area' => $this->area,
            'real_price' => $this->real_price,
            'discount' => $this->discount,
            'sell_price' => $this->sell_price,
            'deposit' => $this->deposit,
            'balance' => $this->balance,
            'creator_id' => $this->creator_id,
            'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'customer', $this->customer])
            ->andFilterWhere(['like', 'contact', $this->contact])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
