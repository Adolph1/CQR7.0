<?php

namespace backend\models;

use Codeception\Subscriber\Module;
use Yii;

/**
 * This is the model class for table "tbl_customer_case".
 *
 * @property integer $id
 * @property string $title
 * @property integer $source
 * @property integer $type
 * @property integer $priority
 * @property integer $customer_number
 * @property string $reported_date
 * @property string $description
 * @property integer $related_activity
 * @property integer $related_module
 * @property integer $related_department
 * @property integer $assigned_to
 * @property integer $escalation_hours
 * @property string $escalation_time
 * @property string $status
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblCaseHistory[] $tblCaseHistories
 * @property TblCustomer $customerNumber
 * @property TblCasePriority $type0
 * @property TblCaseSource $source0
 * @property TblCaseType $type1
 */
class CustomerCase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $customer_name;
    public $total;
    public $department_related;
    const OPENED=1;
    const CLOSED=2;
    const ASSIGN=3;
    const REASSIGN=4;
    const REOPENED=8;
    const UPDATED=9;

    public static function tableName()
    {
        return 'tbl_customer_case';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'source'], 'required'],
            [['source', 'type', 'priority', 'related_activity', 'related_module', 'related_department', 'assigned_to', 'escalation_hours','status','assign_status','update_status'], 'integer'],
            [['description','case_number','delete_status'], 'string'],
            [['escalation_time', 'maker_time'], 'safe'],
            [['title', 'reported_date', 'maker_id'], 'string', 'max' => 200],
            [['customer_number'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_number' => 'id']],
            [['type'], 'exist', 'skipOnError' => true, 'targetClass' => CasePriority::className(), 'targetAttribute' => ['type' => 'id']],
            [['source'], 'exist', 'skipOnError' => true, 'targetClass' => CaseSource::className(), 'targetAttribute' => ['source' => 'id']],
            [['type'], 'exist', 'skipOnError' => true, 'targetClass' => CaseType::className(), 'targetAttribute' => ['type' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'source' => Yii::t('app', 'Source'),
            'type' => Yii::t('app', 'Type'),
            'priority' => Yii::t('app', 'Priority'),
            'customer_number' => Yii::t('app', 'Customer Number'),
            'reported_date' => Yii::t('app', 'Reported Date'),
            'description' => Yii::t('app', 'Description'),
            'related_activity' => Yii::t('app', 'Related Activity'),
            'related_module' => Yii::t('app', 'Related Module'),
            'related_department' => Yii::t('app', 'Related Department'),
            'assigned_to' => Yii::t('app', 'Assigned To'),
            'escalation_hours' => Yii::t('app', 'Escalation Hours'),
            'escalation_time' => Yii::t('app', 'Escalation Time'),
            'assign_status'=>Yii::t('app', 'Assign Status'),
            'update_status'=>Yii::t('app', 'Update Status'),
            'delete_status'=>Yii::t('app', 'Delete Status'),
            'status' => Yii::t('app', 'Status'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblCaseHistories()
    {
        return $this->hasMany(CaseHistory::className(), ['case_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerNumber()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_number']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType0()
    {
        return $this->hasOne(CasePriority::className(), ['id' => 'type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSource0()
    {
        return $this->hasOne(CaseSource::className(), ['id' => 'source']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType1()
    {
        return $this->hasOne(CaseType::className(), ['id' => 'type']);
    }

    public function getModuleActivity()
    {
        return $this->hasOne(ModuleActivity::className(), ['id' => 'related_activity']);
    }

    public function getModule()
    {
        return $this->hasOne(SystemModule::className(), ['id' => 'related_module']);
    }
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'assigned_to']);
    }

    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'related_department']);
    }
    public function getStatusName()
    {
        return $this->hasOne(CaseStatus::className(), ['id' => 'status']);
    }

    public static function getLatest()
    {
        $countnew = CustomerCase::find()
            ->where(['status'=>0])
            ->count();
        $getnews = CustomerCase::find()
            //->where(['!=','status','D'])
            ->orderBy('id DESC')
            ->limit(5)
            ->all();
        if($countnew!=null){
            return $getnews;
        }else{
            return "";
        }
    }
}
