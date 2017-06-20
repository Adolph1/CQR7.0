<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CustomerCase */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-case-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-10 text-center">
            <?= $form->field($model, 'customer_number')->textInput(['placeholder'=>'Search Customer'])->label(false) ?>
        </div>
         <div class="col-md-2 col-sm-2 col-xs-2 pull-right">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '<i class="fa fa-save"></i>') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success ' : 'btn btn-primary btn-block']) ?>
        </div>
    </div>
    <legend class="scheduler-border" style="color:#005DAD">Case details</legend>
<div class="row">

    <div class="col-md-4">
    <?= $form->field($model, 'title')->textInput(['maxlength' => true,'placeholder'=>'Enter case title']) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'case_number')->textInput(['readonly'=>'readonly']) ?>
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
            <?= $form->field($model, 'related_module')->dropDownList(\backend\models\SystemModule::getAll(),['prompt'=>Yii::t('app','--Module--')])->label(false) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'related_activity')->dropDownList(['prompt'=>Yii::t('app','--Activity--')])->label(false) ?>
        </div>

        <div class="col-md-4">
            <legend class="scheduler-border" style="color:#005DAD">Customer details</legend>
        </div>

    </div>
    <div class="row">
    <div class="col-md-2">
    <div class="row">

        <div class="col-md-12">
    <?= $form->field($model, 'source')->dropDownList(\backend\models\CaseSource::getAll(),['prompt'=>Yii::t('app','--Source--')])->label(false) ?>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
    <?= $form->field($model, 'type')->dropDownList(\backend\models\CaseType::getAll(),['prompt'=>Yii::t('app','--Type--')])->label(false) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
      <?= $form->field($model, 'priority')->dropDownList(\backend\models\CasePriority::getAll(),['prompt'=>Yii::t('app','--Priority--')])->label(false) ?>
        </div>

    </div>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'assigned_to')->dropDownList(\backend\models\Employee::getAll(),['prompt'=>Yii::t('app','--Assign To--')])->label(false) ?>
            </div>
        </div>
    </div>
        <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'description')->textarea(['rows' => 6,'placeholder'=>'Enter description'])->label(false) ?>
            </div>

        </div>
            <div class="row">
                <div class="col-md-12">
            <?= $form->field($model, 'assigned_to')->textInput()->label(false) ?>
                </div>
            </div>
        </div>
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

</div>

<script>
    $(document).ready(function(){
        var id ='KCB';
        alert(id);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['customer-case/reference','id'=>'']);?>"+id,function(data) {

            //alert(data);
            $("#expenditure-type").html(data);

        });
    });



</script>
