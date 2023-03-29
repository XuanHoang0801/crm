<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ActionLog;

/**
 * ActionLogSearch represents the model behind the search form of `app\models\ActionLog`.
 */
class ActionLogSearch extends ActionLog
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'content_id'], 'integer'],
            [['data_before', 'data_after', 'created_at', 'url'], 'safe'],
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
        $query = ActionLog::find();

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
            'content_id' => $this->content_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'data_before', $this->data_before])
            ->andFilterWhere(['like', 'data_after', $this->data_after])
            ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
