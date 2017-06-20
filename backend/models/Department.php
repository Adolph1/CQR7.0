<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_department".
 *
 * @property integer $id
 * @property string $dept_name
 * @property integer $parent
 * @property string $status
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblDepartmentModuleActivity[] $tblDepartmentModuleActivities
 * @property TblEmployee[] $tblEmployees
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_department';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dept_name'], 'required'],
            [['parent'], 'integer'],
            [['maker_time'], 'safe'],
            [['dept_name', 'maker_id'], 'string', 'max' => 200],
            [['status'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'dept_name' => Yii::t('app', 'Department Name'),
            'parent' => Yii::t('app', 'Parent'),
            'status' => Yii::t('app', 'Status'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblDepartmentModuleActivities()
    {
        return $this->hasMany(DepartmentModuleActivity::className(), ['department_id' => 'id']);
    }

    //gets all departments

    public static function getAll()
    {
        return ArrayHelper::map(Department::find()->all(),'id','dept_name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblEmployees()
    {
        return $this->hasMany(Employee::className(), ['department_id' => 'id']);
    }
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'parent']);
    }
}
