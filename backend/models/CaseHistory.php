<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_case_history".
 *
 * @property integer $id
 * @property integer $case_id
 * @property string $date
 * @property string $description
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblCustomerCase $case
 */
class CaseHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_case_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['case_id'], 'integer'],
            [['date', 'maker_time'], 'safe'],
            [['description'], 'string'],
            [['maker_id'], 'string', 'max' => 200],
            [['case_id'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerCase::className(), 'targetAttribute' => ['case_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'case_id' => Yii::t('app', 'Case ID'),
            'date' => Yii::t('app', 'Date'),
            'description' => Yii::t('app', 'Description'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCase()
    {
        return $this->hasOne(CustomerCase::className(), ['id' => 'case_id']);
    }
}
