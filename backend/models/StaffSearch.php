<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Staff;

/**
 * StaffSearch represents the model behind the search form of `app\models\Staff`.
 */
class StaffSearch extends Staff
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'phone', 'email', 'province_id'], 'integer'],
            [['name', 'staff_code'], 'safe'],
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
        $query = Staff::find();

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
            'phone' => $this->phone,
            'email' => $this->email,
            'province_id' => $this->province_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'staff_code', $this->staff_code]);

        return $dataProvider;
    }
}
