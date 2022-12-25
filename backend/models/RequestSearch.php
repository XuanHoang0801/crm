<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Request;

/**
 * RequestSearch represents the model behind the search form of `app\models\Request`.
 */
class RequestSearch extends Request
{
    public $project;
    public $user;
    public $level;
    public $status;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'deadline', 'project_id', 'user_id', 'status_id', 'level_id'], 'integer'],
            [['name', 'detail', 'image', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
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
        $query = Request::find();

        // add conditions that should always apply here
        $query->joinWith(['project', 'user','level', 'status']);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['Dự án'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['project.name' => SORT_ASC],
            'desc' => ['project.name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['Giao cho'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['Cấp độ'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['level.name' => SORT_ASC],
            'desc' => ['level.name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['Trạng thái'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['status.name' => SORT_ASC],
            'desc' => ['status.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'deadline' => $this->deadline,
            'project_id' => $this->project_id,
            'user_id' => $this->user_id,
            'status_id' => $this->status_id,
            'level_id' => $this->level_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'project.name', $this->project])
            ->andFilterWhere(['like', 'user.username', $this->user])
            ->andFilterWhere(['like', 'level.name', $this->level])
            ->andFilterWhere(['like', 'status.username', $this->status]);

        return $dataProvider;
    }
}
