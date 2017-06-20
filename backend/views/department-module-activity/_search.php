<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DepartmentModuleActivitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="department-module-activity-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'module_activity_id') ?>

    <?= $form->field($model, 'department_id') ?>

    <?= $form->field($model, 'related_module') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'maker_id') ?>

    <?php // echo $form->field($model, 'maker_time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
