<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SystemModule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="system-module-form">
    <legend class="scheduler-border" style="color:#005DAD">Module details</legend>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'module_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'status')->dropDownList(['1'=>'Active','0'=>'disable'],['prompt'=>Yii::t('app','--Select--')]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
