<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CaseStatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Case Statuses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="case-status-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Case Status'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'status_name',
            [
              'attribute'=>'type',
                'value'=>function($model){
                    if($model->type==1){
                        return "Case Status";
                    }elseif ($model->type==2){
                        return "Assign Status";
                    }
                    elseif ($model->type==3){
                        return "Update Status";
                    }
                }
            ],

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
