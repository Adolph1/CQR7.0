<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\DepartmentModuleActivity */

$this->title = Yii::t('app', 'Add Department Module Activity');
?>
<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-server"></i><strong> LINK MODULE ACTIVITY TO DEPARTMENT</strong></h3>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12 pull-right">
        <div class="btn-group btn-group-justified">
            <?= Html::a(Yii::t('app', '<i class="fa fa-plus text-white"></i> Link module activity to department'), ['create'], ['class' => 'btn btn-primary btn-block']) ?>
            <?= Html::a(Yii::t('app', '<i class="fa fa-search text-white"></i> Advance search'), ['advancesearch'], ['class' => 'btn btn-primary btn-block']) ?>
            <?= Html::a(Yii::t('app', ' <i class="fa fa-eye text-white"></i> View department activities'), ['index'], ['class' => 'btn btn-primary btn-block']) ?>
        </div>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>
