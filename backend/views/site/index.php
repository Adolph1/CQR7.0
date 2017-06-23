<?php

/* @var $this yii\web\View */

$this->title = 'QR5.0';
use yii\bootstrap\Html;
use backend\models\CustomerCaseSearch;
use sjaakp\gcharts\PieChart;
use sjaakp\gcharts\LineChart;
?>
<div class="row" >

    <div class="col-lg-6 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <?php
                $searchModel1 = new CustomerCaseSearch();
                $dataProvider1 = $searchModel1->lineChart();
                ?>
                <?= \sjaakp\gcharts\LineChart::widget([
                    'height' => '400px',
                    'dataProvider' => $dataProvider1,
                    'columns' => [

                        [
                            'attribute'=>'related_activity',
                            'value'=>function($model, $a, $i, $w) {
                                return $model->moduleActivity->activity_name;
                            },
                            'type' => 'string',
                            //'role' => 'tooltip',
                        ],
                        'total:number',
                        //'reported_date:date',




                    ],
                    'options' => [
                        'title' => 'Cases logged from '.date('Y').'-'.date('m').'-'.'01'.' To '. date('Y').'-'.date('m').'-'.'31'
                    ],
                ]) ?>

            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
        </div>
    </div><!-- ./col -->

    <div class="col-lg-6 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <?php
                $searchModel = new CustomerCaseSearch();
                $dataProvider = $searchModel->PieChart();
                ?>
                <?= PieChart::widget([
                    'height' => '400px',
                    'dataProvider' => $dataProvider,
                    'columns' => [


                        [
                            'attribute'=>'related_activity',
                            'value'=>function($model, $a, $i, $w) {
                                return $model->moduleActivity->activity_name;
                            },
                            'type' => 'string',
                            //'role' => 'tooltip',
                        ],

                        'total:number',
                        //'reported_date:date',







                    ],
                    'options' => [
                        'title' => 'Cases logged from '.date('Y').'-'.date('m').'-'.'01'.' To '. date('Y').'-'.date('m').'-'.'31'
                    ],
                ]) ?>

            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
        </div>
    </div><!-- ./col -->
    <div class="col-md-12 col-md-12 col-sm-12 col-sx-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money"></i> Recently logged customer cases</h3>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr style="font-size: large;color: #0a0a0a">
                        <td>Date</td>
                        <td>Title</td>
                        <td>Related Activity</td>
                        <td>Related Department</td>
                        <td>Description</td>
                        <td>Customer Name</td>
                        <td>Customer Number</td>
                        <td>Status</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $getnews=\backend\models\CustomerCase::getLatest();

                    if($getnews!=null){
                        foreach($getnews as $getnew){
                            if($getnew->status==\backend\models\CustomerCase::OPENED){
                                $getnew->status='Pending';
                            }elseif($getnew->status==\backend\models\CustomerCase::CLOSED){
                                $getnew->status='Closed';
                            }
                            echo '<tr>
                        <td>'.$getnew->reported_date.'</td>
                        <td>'.$getnew->title.'</td>
                        <td>'.$getnew->moduleActivity->activity_name.'</td>
                         <td>'.$getnew->department->dept_name.'</td>
                        <td>'.$getnew->description.'</td>
                        <td>'.$getnew->customerNumber->name.'</td>
                         <td>'.$getnew->customerNumber->customer_number.'</td>
                         <td>'.$getnew->status.'</td>
                        </tr>';
                        }
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
