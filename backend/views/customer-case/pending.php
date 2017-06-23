<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CustomerCaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Customer Cases');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-server"></i><strong> MY PENDING CASES</strong></h3>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12 pull-right">
        <div class="btn-group btn-group-justified">
            <?php  if(Yii::$app->user->can('Level0')) echo Html::a(Yii::t('app', '<i class="fa fa-plus text-white"></i> New case'), ['create'], ['class' => 'btn btn-primary btn-block']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-search text-white"></i> Advance search'), ['advancesearch'], ['class' => 'btn btn-primary btn-block']) ?>
            <?php  if(Yii::$app->user->can('Level5')) echo Html::a(Yii::t('app', '<i class="fa fa-list text-white"></i> My cases'), ['pending'], ['class' => 'btn btn-primary btn-block']) ?>
            <?= Html::a(Yii::t('app', ' <i class="fa fa-eye text-white"></i> View my department cases'), ['index'], ['class' => 'btn btn-primary btn-block']) ?>
        </div>
        <hr>
    </div>
</div>
<div class="customer-case-index">

    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'case_number',
            'title',
            [
                'attribute'=>'source',
                'value'=>'source0.title'
            ],
            [
                'attribute'=>'type',
                'value'=>'type1.title'
            ],
            [
                'attribute'=>'priority',
                'value'=>'type0.title'
            ],
            [
                'header'=>'Customer Name',
                'attribute'=>'customer_number',
                'value'=>'customerNumber.name'
            ],
            'description:ntext',
            [
                'attribute'=>'assigned_to',
                'value'=> 'employee.first_name',
            ],
        [
            'attribute'=>'assign_status',
            'value'=>function($model){
                if($model->assign_status==\backend\models\CustomerCase::ASSIGN){
                    return "Assigned";
                }else{
                    return "Not Assigned";
                }

            }
        ],
        [
            'attribute'=>'update_status',
            'value'=>function($model){
                if($model->update_status==\backend\models\CustomerCase::UPDATED){
                    return "Updated";
                }else{
                    return "Not updated";
                }

            }
        ],

            'reported_date',
            'escalation_hours',
            'escalation_time',
            [
                    'attribute'=>'status',
                    'value'=>function($model){
                    if($model->status==\backend\models\CustomerCase::OPENED){
                        return "Opened";
                    }elseif ($model->status==\backend\models\CustomerCase::CLOSED){
                        return "Closed";
                    }

                    }
            ],

            [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'Actions',
                'template'=>'{view}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        $url=['view','id' => $model->id];
                        return Html::a('<span class="fa fa-eye"></span>', $url, [
                            'title' => 'View',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'class'=>'btn btn-info',

                        ]);


                    },

                ]
            ],
        ],
    ]); ?>
</div>
