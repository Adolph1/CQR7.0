<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model backend\models\CustomerCase */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-case-form">

    <?php $form = ActiveForm::begin(); ?>
    <legend class="scheduler-border" style="color:#005DAD"><strong><i class="fa fa-envelope text-danger"></i> CASE DETAILS</strong></legend>
    <div class="row">
        <div class="col-md-8">
            <div class="btn-group btn-group-justified">
                <?php  if(Yii::$app->user->can('Level0')) echo Html::a(Yii::t('app', '<i class="fa fa-plus text-white"></i> New case'), ['create'], ['class' => 'btn btn-primary btn-block']) ?>
                <?php if(Yii::$app->user->can('Level0') && $model->status!=\backend\models\CustomerCase::CLOSED) echo Html::a(Yii::t('app', '<i class="fa fa-edit text-white"></i> Update Case'), ['update','id' => $model->id], ['class' => 'btn btn-primary btn-block']) ?>
                <?php if(Yii::$app->user->can('Level0') && $model->status!=\backend\models\CustomerCase::CLOSED) echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
                <?php  if(Yii::$app->user->can('Level5')) echo Html::a(Yii::t('app', '<i class="fa fa-list text-white"></i> My cases'), ['pending'], ['class' => 'btn btn-primary btn-block']) ?>
                <?= Html::a(Yii::t('app', ' <i class="fa fa-eye text-white"></i> View my department cases'), ['index'], ['class' => 'btn btn-primary btn-block']) ?>
            </div>
        </div>
    <div class="col-md-1">
        <?php if(Yii::$app->user->can('Level0') && $model->status!=\backend\models\CustomerCase::CLOSED) { ?>
            <?php
            Modal::begin([
                'header' => '<h2>Reassign Case</h2>',
                'toggleButton' => ['label' => '<i class="fa fa-retweet"></i> Reassign', 'class' => (Yii::$app->user->can('Level0') && $model->status != \backend\models\CustomerCase::CLOSED) ? 'btn btn-default enabled btn-block' : 'btn btn-default disabled btn-block'],
                'size' => Modal::SIZE_SMALL,
                'options' => ['class' => 'slide'],
            ]);
            ?>

            <?php $form = ActiveForm::begin(); ?>


            <?= $form->field($model, 'assigned_to')->dropDownList(\backend\models\Employee::getAll(), ['prompt' => Yii::t('app', '--Activity--')]) ?>

            <?= $form->field($model, 'id')->textInput()->hiddenInput(['id' => 'case-id'])->label(false) ?>


            <?= Html::Button(Yii::t('app', '<i class="fa fa-retweet"></i> Reassign'), [
                'class' => 'btn btn-info',
                'value' => 'Reassign',
                'id' => 'reassign-user',
                'name' => 'submit',
            ]) ?>


            <?php ActiveForm::end(); ?>


            <?php

            Modal::end();
        }
            ?>
    </div>
        <div class="col-md-1">
            <?php if(Yii::$app->user->can('Level5') && $model->assigned_to==Yii::$app->user->identity->emp_id && $model->status!=\backend\models\CustomerCase::CLOSED){?>
            <?php
            Modal::begin([
                'header' => '<h2>Update Case</h2>',
                'toggleButton' => ['label' => '<i class="fa fa-file-o"></i> Update','class' =>Yii::$app->user->can('Level5') && $model->assigned_to==Yii::$app->user->identity->emp_id && $model->status!=\backend\models\CustomerCase::CLOSED ? 'btn btn-default enabled btn-block':'btn btn-default disabled btn-block'],
                'size' => Modal::SIZE_LARGE,
                'options' => ['class'=>'slide'],
            ]);
            ?>
            <?php $form = ActiveForm::begin([
                'action' => ['case-history/create']
                ,]); ?>


                <?= $form->field($casehistory, 'case_id')->hiddenInput(['value'=>$model->id])->label(false) ?>
                <?= $form->field($casehistory, 'description')->textarea(['rows' => 3]) ?>

            <?= Html::submitButton($casehistory->isNewRecord ? Yii::t('app', '<i class="fa fa-save"></i> Submit') : Yii::t('app', 'Update'), ['class' => $casehistory->isNewRecord ? 'btn btn-default' : 'btn btn-primary btn-block']) ?>


                <?php ActiveForm::end(); ?>
                <?php

                Modal::end();
            }
                ?>

    </div>
        <div class="col-md-1">
            <?= Html::a(Yii::t('app', '<i class="fa fa-lock"></i> Close'), ['close', 'id' => $model->id],
                [
                    'class' =>Yii::$app->user->can('Level0') && $model->status!=\backend\models\CustomerCase::CLOSED? 'btn btn-default enabled btn-block':'btn btn-default disabled btn-block',

                ]);
              ?>
        </div>
        <div class="col-md-1">
            <?= Html::a(Yii::t('app', '<i class="fa fa-unlock"></i> Reopen'), ['reopen', 'id' => $model->id], ['class' =>Yii::$app->user->can('Level0') && $model->status==\backend\models\CustomerCase::CLOSED ? 'btn btn-default enabled btn-block':'btn btn-default disabled btn-block']) ?>
        </div>

    </div>
    <hr/>




    </div>
    <div class="row">

        <div class="col-md-4">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true,'placeholder'=>'Enter case title','readonly'=>'readonly']) ?>
        </div>
        <div class="col-md-2">
            <?=$model->isNewRecord ? $form->field($model, 'case_number')->textInput() : $form->field($model, 'case_number')->textInput(['value'=>$model->case_number,'readonly'=>'readonly','id'=>'casenumber'])?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'reported_date')->textInput(['readonly'=>'readonly','value'=>date('Y-m-d')]) ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'escalation_hours')->textInput(['readonly'=>'readonly']) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'escalation_time')->textInput(['readonly'=>'readonly']) ?>
        </div>


    </div>
    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'related_module')->dropDownList(\backend\models\SystemModule::getAll(),['prompt'=>Yii::t('app','--Module--'),'disabled'=>'disabled'])->label(false) ?>
        </div>
        <div class="col-md-6">
            <?=$model->isNewRecord ? $form->field($model, 'related_activity')->dropDownList(['prompt'=>Yii::t('app','--Activity--')])->label(false) : $form->field($model, 'related_activity')->dropDownList(\backend\models\ModuleActivity::getAll(),['prompt'=>Yii::t('app','--Activity--'),'disabled'=>'disabled'])->label(false)?>
        </div>



    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="row">

                <div class="col-md-12">
                    <?= $form->field($model, 'source')->dropDownList(\backend\models\CaseSource::getAll(),['prompt'=>Yii::t('app','--Source--'),'disabled'=>'disabled'])->label(false) ?>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'type')->dropDownList(\backend\models\CaseType::getAll(),['prompt'=>Yii::t('app','--Type--'),'disabled'=>'disabled'])->label(false) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'priority')->dropDownList(\backend\models\CasePriority::getAll(),['prompt'=>Yii::t('app','--Priority--'),'disabled'=>'disabled'])->label(false) ?>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <?=$model->isNewRecord ? $form->field($model, 'assigned_to')->dropDownList(['prompt'=>Yii::t('app','--Activity--')])->label(false) : $form->field($model, 'assigned_to')->dropDownList(\backend\models\Employee::getAll(),['prompt'=>Yii::t('app','--Activity--'),'disabled'=>'disabled'])->label(false)?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php if(!$model->isNewRecord) echo $form->field($model, 'status')->textInput(['value'=>$model->statusName->status_name,'readonly'=>'readonly']); ?>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <legend class="scheduler-border" style="color:#005DAD"><strong>Other Cases</strong></legend>
                </div>
            </div>
            <?php ActiveForm::end(); ?>


        </div>
        <?php $form = ActiveForm::begin(); ?>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'description')->textarea(['rows' => 6,'placeholder'=>'Enter description','disabled'=>'disabled'])->label(false) ?>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php if(!$model->isNewRecord) echo $form->field($model, 'related_department')->textInput(['readonly'=>'readonly','value'=>$model->department->dept_name])->label(false) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            <div class="row">
            <div class="col-md-12">
                <legend class="scheduler-border" style="color:#005DAD"><strong>Cases Review Messages</strong></legend>
            </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p></p><h4 class="text-info"></h4><p></p>
                <?php
                $updates=\backend\models\CaseHistory::getHistory($model->id);

                if($updates!=null){
                    foreach ($updates as $update){

                        echo '<div style="border: #ccc solid thin;padding:10px"><a href="#">'.$update->maker_id.'</a> at '.$update->maker_time;
                        echo '<p>'.$update->description.'</p></div><br/>';


                    }
                }

                ?>


                </div>

            </div>
        </div>
        <?php $form = ActiveForm::begin(); ?>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($customer, 'customer_number')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($customer, 'name')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($customer, 'account_1')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($customer, 'account_2')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($customer, 'phone_1')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($customer, 'phone_2')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($customer, 'address')->textarea(['rows' => 3,'readonly'=>'readonly']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($customer, 'email')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
                </div>
            </div>
        </div>
    </div>





    <?php ActiveForm::end(); ?>




