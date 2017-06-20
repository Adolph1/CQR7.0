<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DepartmentModuleActivity;

/**
 * DepartmentModuleActivitySearch represents the model behind the search form about `backend\models\DepartmentModuleActivity`.
 */
class DepartmentModuleActivitySearch extends DepartmentModuleActivity
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'module_activity_id', 'department_id', 'related_module'], 'integer'],
            [['status', 'maker_id', 'maker_time'], 'safe'],
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
        $query = DepartmentModuleActivity::find();

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
            'module_activity_id' => $this->module_activity_id,
            'department_id' => $this->department_id,
            'related_module' => $this->related_module,
            'maker_time' => $this->maker_time,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id]);

        return $dataProvider;
    }
}
