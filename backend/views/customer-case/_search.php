<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CustomerCaseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-case-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'source') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'priority') ?>

    <?php // echo $form->field($model, 'customer_number') ?>

    <?php // echo $form->field($model, 'reported_date') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'related_activity') ?>

    <?php // echo $form->field($model, 'related_module') ?>

    <?php // echo $form->field($model, 'related_department') ?>

    <?php // echo $form->field($model, 'assigned_to') ?>

    <?php // echo $form->field($model, 'escalation_hours') ?>

    <?php // echo $form->field($model, 'escalation_time') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'maker_id') ?>

    <?php // echo $form->field($model, 'maker_time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
