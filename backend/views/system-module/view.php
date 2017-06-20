<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SystemModule */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-th"></i><strong> SYSTEM MODULE DETAILS</strong></h3>
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
    <?php $form = ActiveForm::begin(); ?>
        <legend class="scheduler-border" style="color:#005DAD">Module details</legend>

    <?= $form->field($model, 'module_name')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>


    <?= $form->field($model, 'status')->dropDownList(['1'=>'Active','0'=>'disable'],['prompt'=>Yii::t('app','--Select--')]) ?>



    <div class="form-group">
        <div class="col-md-4 pull-right">
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-block']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>
