<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DepartmentModuleActivity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="department-module-activity-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'module_activity_id')->dropDownList(\backend\models\ModuleActivity::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>

    <?= $form->field($model, 'department_id')->dropDownList(\backend\models\Department::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>


    <?= $form->field($model, 'status')->dropDownList(['1'=>'Active','0'=>'disable'],['prompt'=>Yii::t('app','--Select--')]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
