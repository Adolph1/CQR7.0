<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_department_module_activity".
 *
 * @property integer $id
 * @property integer $module_activity_id
 * @property integer $department_id
 * @property integer $related_module
 * @property string $status
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblDepartment $department
 * @property TblModuleActivity $moduleActivity
 */
class DepartmentModuleActivity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $activity_module;

    public static function tableName()
    {
        return 'tbl_department_module_activity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module_activity_id', 'department_id',], 'integer'],
            [['maker_time'], 'safe'],
            [['status'], 'string', 'max' => 1],
            [['maker_id'], 'string', 'max' => 200],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
            [['module_activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => ModuleActivity::className(), 'targetAttribute' => ['module_activity_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'module_activity_id' => Yii::t('app', 'Module Activity'),
            'department_id' => Yii::t('app', 'Department'),
            'related_module' => Yii::t('app', 'Related Module'),
            'status' => Yii::t('app', 'Status'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleActivity()
    {
        return $this->hasOne(ModuleActivity::className(), ['id' => 'module_activity_id']);
    }
}
