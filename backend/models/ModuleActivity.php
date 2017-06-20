<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "tbl_module_activity".
 *
 * @property integer $id
 * @property string $activity_name
 * @property integer $module_id
 * @property string $status
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblSystemModule $module
 */
class ModuleActivity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_module_activity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_name'], 'required'],
            [['module_id'], 'integer'],
            [['maker_time'], 'safe'],
            [['activity_name', 'maker_id'], 'string', 'max' => 200],
            [['status'], 'string', 'max' => 1],
            [['module_id'], 'exist', 'skipOnError' => true, 'targetClass' => SystemModule::className(), 'targetAttribute' => ['module_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'activity_name' => Yii::t('app', 'Activity Name'),
            'module_id' => Yii::t('app', 'Module'),
            'status' => Yii::t('app', 'Status'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(SystemModule::className(), ['id' => 'module_id']);
    }

    //gets all departments

    public static function getAll()
    {
        return ArrayHelper::map(ModuleActivity::find()->all(),'id','activity_name');
    }

    public static function getModuleID($id)
    {
        if (($model = ModuleActivity::findOne($id)) !== null) {
            return $model->module_id;
        } else {

            return "";
        }
    }
}
