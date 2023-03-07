<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Transaction;

/**
 * TransactionSearch represents the model behind the search form of `app\models\Transaction`.
 */
class TransactionSearch extends Transaction
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'total', 'status'], 'integer'],
            [['code', 'unit_id', 'time_start', 'time_end', 'package_id'], 'safe'],
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
        $query = Transaction::find();

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
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
            'total' => $this->total,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'unit_id', $this->unit_id])
            ->andFilterWhere(['like', 'package_id', $this->package_id]);

        return $dataProvider;
    }
}
