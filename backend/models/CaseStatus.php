<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_case_status".
 *
 * @property integer $id
 * @property string $status_name
 * @property string $type
 */
class CaseStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    const CASE_STATUS=1;
    const ASSIGN_STATUS=2;
    const CASE_UPDATE=3;


    public static function tableName()
    {
        return 'tbl_case_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_name'], 'string', 'max' => 200],
            [['type'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'status_name' => Yii::t('app', 'Status Name'),
            'type' => Yii::t('app', 'Type'),
        ];
    }
}
