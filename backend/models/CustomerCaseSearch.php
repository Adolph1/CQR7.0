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
            [['title', 'reported_date', 'description', 'escalation_time', 'status', 'maker_id', 'maker_time'], 'safe'],
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
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'reported_date', $this->reported_date])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id]);

        return $dataProvider;
    }
}
