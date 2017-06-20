<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ModuleActivity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="module-activity-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'module_id')->dropDownList(\backend\models\SystemModule::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>
    </div>
    <div class="col-md-6">
    <?= $form->field($model, 'activity_name')->textInput(['maxlength' => true]) ?>
    </div>

</div>
    <div class="row">
        <div class="col-md-12">
    <?= $form->field($model, 'status')->dropDownList(['1'=>'Active','0'=>'disable'],['prompt'=>Yii::t('app','--Select--')]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
