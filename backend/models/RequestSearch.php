<?php

namespace app\models;

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
            [['id', 'deadline'], 'integer'],
            [['name', 'detail', 'image','project','status','user', 'level', 'time_start', 'time_end'], 'safe'],
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
        $query->joinWith(['project', 'user','level','status']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['project'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['project.name' => SORT_ASC],
            'desc' => ['project.name' => SORT_DESC],
        ];
        // Lets do the same with country now
        $dataProvider->sort->attributes['user'] = [
            'asc' => ['user.fullname' => SORT_ASC],
            'desc' => ['user.fullname' => SORT_DESC],
        ];
        // Lets do the same with country now
        $dataProvider->sort->attributes['status'] = [
            'asc' => ['status.name' => SORT_ASC],
            'desc' => ['status.name' => SORT_DESC],
        ];
        // Lets do the same with country now
        $dataProvider->sort->attributes['level'] = [
            'asc' => ['level.name' => SORT_ASC],
            'desc' => ['level.name' => SORT_DESC],
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
            'name' =>$this->name,
            'deadline' => $this->deadline,
            'project.name' => $this->project_id,
            'user.fullname' => $this->user_id,
            'status.name' => $this->status_id,
            'level.name' => $this->level_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'project.name', $this->project])
            ->andFilterWhere(['like', 'user.fullname', $this->user])
            ->andFilterWhere(['like', 'status.name', $this->status])
            ->andFilterWhere(['like', 'level.fullname', $this->level]);


        return $dataProvider;
    }
}
