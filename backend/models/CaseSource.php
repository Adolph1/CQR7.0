<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_case_source".
 *
 * @property integer $id
 * @property string $title
 *
 * @property TblCustomerCase[] $tblCustomerCases
 */
class CaseSource extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_case_source';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 100],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblCustomerCases()
    {
        return $this->hasMany(CustomerCase::className(), ['source' => 'id']);
    }


    //gets all sources

    public static function getAll()
    {
        return ArrayHelper::map(CaseSource::find()->all(),'id','title');
    }
}
