<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SystemModuleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'System Modules');
?>
<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-server"></i><strong> SYSTEM MODULE LIST</strong></h3>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12 pull-right">
        <div class="btn-group btn-group-justified">
            <?= Html::a(Yii::t('app', '<i class="fa fa-plus text-white"></i> Add system module'), ['create'], ['class' => 'btn btn-primary btn-block']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-search text-white"></i> Advance search'), ['advancesearch'], ['class' => 'btn btn-primary btn-block']) ?>
            <?= Html::a(Yii::t('app', ' <i class="fa fa-eye text-white"></i> View system module List'), ['index'], ['class' => 'btn btn-primary btn-block']) ?>
        </div>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'module_name',
            'description',
            'status',


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
</div>