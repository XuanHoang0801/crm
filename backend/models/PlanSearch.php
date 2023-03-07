<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Plan;

/**
 * PlanSearch represents the model behind the search form of `app\models\Plan`.
 */
class PlanSearch extends Plan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'form'], 'integer'],
            [['name', 'customer_id', 'time_start', 'time_end', 'unit_id', 'content', 'error', 'request', 'fix'], 'safe'],
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
        $query = Plan::find();

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
            'form' => $this->form,
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'customer_id', $this->customer_id])
            ->andFilterWhere(['like', 'unit_id', $this->unit_id])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'error', $this->error])
            ->andFilterWhere(['like', 'request', $this->request])
            ->andFilterWhere(['like', 'fix', $this->fix]);

        return $dataProvider;
    }
}
