<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ReserveAccessories;

/**
 * ReserveAccessorieslsSearch represents the model behind the search form of `app\models\ReserveAccessories`.
 */
class ReserveAccessorieslsSearch extends ReserveAccessories
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'code', 'creator_id'], 'integer'],
            [['name', 'unit', 'created_date'], 'safe'],
            [['count', 'price', 'total', 'current_count', 'current_total'], 'number'],
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
        $query = ReserveAccessories::find();

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
            'code' => $this->code,
            'count' => $this->count,
            'price' => $this->price,
            'total' => $this->total,
            'current_count' => $this->current_count,
            'current_total' => $this->current_total,
            'creator_id' => $this->creator_id,
            'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'unit', $this->unit]);

        return $dataProvider;
    }
}
