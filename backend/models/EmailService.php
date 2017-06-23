<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_email_service".
 *
 * @property integer $id
 * @property string $from
 * @property string $to
 * @property string $message
 * @property string $time_sent
 */
class EmailService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_email_service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message'], 'string'],
            [['time_sent'], 'safe'],
            [['from', 'to'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'from' => Yii::t('app', 'From'),
            'to' => Yii::t('app', 'To'),
            'message' => Yii::t('app', 'Message'),
            'time_sent' => Yii::t('app', 'Time Sent'),
        ];
    }


}
