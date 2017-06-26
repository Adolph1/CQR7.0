<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_email_log".
 *
 * @property integer $id
 * @property string $title
 * @property string $from
 * @property string $to
 * @property string $subject
 * @property string $message
 * @property string $case_reference_number
 * @property integer $status
 */
class EmailLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_email_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message'], 'string'],
            [['status'], 'integer'],
            [['title', 'from', 'to', 'subject', 'case_reference_number'], 'string', 'max' => 200],
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
            'from' => Yii::t('app', 'From'),
            'to' => Yii::t('app', 'To'),
            'subject' => Yii::t('app', 'Subject'),
            'message' => Yii::t('app', 'Message'),
            'case_reference_number' => Yii::t('app', 'Case Reference Number'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
