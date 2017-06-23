<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CustomerCase;

/**
 * CustomerCaseSearch represents the model behind the search form about `backend\models\CustomerCase`.
 */
class CustomerCaseSearch extends CustomerCase
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'source', 'type', 'priority', 'customer_number', 'related_activity', 'related_module', 'related_department', 'assigned_to', 'escalation_hours'], 'integer'],
            [['title', 'reported_date', 'description', 'escalation_time', 'status','assign_status','update_status', 'maker_id', 'maker_time'], 'safe'],
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
        $query = CustomerCase::find();

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
            'source' => $this->source,
            'type' => $this->type,
            'priority' => $this->priority,
            'customer_number' => $this->customer_number,
            'related_activity' => $this->related_activity,
            'related_module' => $this->related_module,
            'related_department' => $this->related_department,
            'assigned_to' => $this->assigned_to,
            'escalation_hours' => $this->escalation_hours,
            'escalation_time' => $this->escalation_time,
            'maker_time' => $this->maker_time,
            'status'=>$this->status,
            'assign_status'=>$this->assign_status,
            'update_status'=>$this->update_status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'reported_date', $this->reported_date])
            ->andFilterWhere(['like', 'description', $this->description])

            ->andFilterWhere(['like', 'maker_id', $this->maker_id]);

        return $dataProvider;
    }

    public function searchPending($params)
    {
        $query = CustomerCase::find();

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
            'source' => $this->source,
            'type' => $this->type,
            'priority' => $this->priority,
            'customer_number' => $this->customer_number,
            'related_activity' => $this->related_activity,
            'related_module' => $this->related_module,
            'related_department' => $this->related_department,
            'assigned_to' => $this->assigned_to,
            'escalation_hours' => $this->escalation_hours,
            'escalation_time' => $this->escalation_time,
            'maker_time' => $this->maker_time,
            'status'=>CustomerCase::OPENED,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'reported_date', $this->reported_date])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id]);

        return $dataProvider;
    }


//Branch Manager search all her/his pending expenditures
    public function searchPendingByUser($params)
    {
        $query = CustomerCase::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'assigned_to' => $params,
           'status'=>CustomerCase::OPENED,

        ]);

        return $dataProvider;
    }

    public function searchPendingByDepartment($params)
    {
        $query = CustomerCase::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'related_department' => $params,
            //'status'=>CustomerCase::PENDING,

        ]);

        return $dataProvider;
    }

    public function lineChart()
    {
        $query=CustomerCase::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $pagination = false;
        $query->select(['count(*) as total','reported_date','related_activity']);
        //$query->andWhere(['!=', 'status', 'U']);
        $query->andWhere(['between', 'reported_date', date('Y').'-'.date('m').'-'.'01',  date('Y').'-'.date('m').'-'.'31']);
        $query->groupBy(['related_activity']);
        return $dataProvider;
    }

    public function PieChart()
    {
        $query=CustomerCase::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $pagination = false;
        $query->select(['count(*) as total','reported_date','related_activity']);
        //$query->andWhere(['!=', 'status', 'U']);
        $query->andFilterWhere(['between', 'reported_date', date('Y').'-01-01',  date('Y').'-'.date('m').'-'.'31']);
        $query->groupBy(['related_activity']);
        return $dataProvider;
    }


}
