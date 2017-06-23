<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_customer".
 *
 * @property integer $id
 * @property string $customer_number
 * @property string $name
 * @property string $account_1
 * @property string $account_2
 * @property string $phone_1
 * @property string $phone_2
 * @property string $address
 * @property string $email
 * @property string $status
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblCase[] $tblCases
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    const SCENARIO_CREATE = 'create';

    public static function tableName()
    {
        return 'tbl_customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_number', 'name', 'phone_1'], 'required'],
            [['address'], 'string'],
            [['maker_time'], 'safe'],
            [['customer_number', 'name', 'account_1', 'account_2', 'phone_1', 'phone_2', 'email', 'maker_id'], 'string', 'max' => 200],
            [['status'], 'string', 'max' => 1],

        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['customer_number','name', 'account_1', 'account_2', 'phone_1', 'phone_2', 'email', 'address','status','maker_id','maker_time'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'customer_number' => Yii::t('app', 'Customer Number'),
            'name' => Yii::t('app', 'Name'),
            'account_1' => Yii::t('app', 'Account 1'),
            'account_2' => Yii::t('app', 'Account 2'),
            'phone_1' => Yii::t('app', 'Phone 1'),
            'phone_2' => Yii::t('app', 'Phone 2'),
            'address' => Yii::t('app', 'Address'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblCases()
    {
        return $this->hasMany(TblCase::className(), ['customer_number' => 'id']);
    }
}
