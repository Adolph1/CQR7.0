<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model backend\models\CustomerCase */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-case-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-8 text-center">
            <?php

            $data = \backend\models\Customer::find()
                ->select(['name as value', 'name as  label','id as id'])
                ->asArray()
                ->all();

            //echo 'Product Name' .'<br>';
            echo AutoComplete::widget([
                'options'=>[
                    'placeholder'=>'Enter customer number',
                    'class'=>'col-md-12',
                    'style'=>'padding:6px',
                    'id'=>'customercase-customer_number',
                ],
                'clientOptions' => [
                    'source' => $data,
                    'minLength'=>'3',
                    'autoFill'=>true,
                    'select' => new JsExpression("function( event, ui ) {
                    
                    $('#memberssearch-family_name_id').val(ui.item.id);
                    var id=ui.item.id;
                    alert(ui.item.id);
                   // $('#prod-id').html(id);
                      $.get('".Yii::$app->urlManager->createUrl(['customer/get-customer','id'=>''])."'+id,function(data) {
                    
                    if(data){
                        window.location.reload(true);
                        }

                     });
     
                 }")],
            ]);
            ?>
            <?= Html::activeHiddenInput($model, 'customer_name',['id'=>'prd-id'])?>

        </div>
        <div class="col-md-2">
            <?= Html::Button(Yii::t('app', '<i class="fa fa-search"></i> Get Customer'), [
                'class' => 'btn btn-default btn-block',
                'value'=> 'Get Customer',
                'id'=>'customer-id',
                'name' => 'submit',
            ]) ?></div>

    </div>
    <legend class="scheduler-border" style="color:#005DAD">Case details</legend>
<div class="row">

    <div class="col-md-4">
    <?= $form->field($model, 'title')->textInput(['maxlength' => true,'placeholder'=>'Enter case title']) ?>
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
            <?= $form->field($model, 'related_module')->dropDownList(\backend\models\SystemModule::getAll(),['prompt'=>Yii::t('app','--Module--')])->label(false) ?>
        </div>
        <div class="col-md-6">
            <?=$model->isNewRecord ? $form->field($model, 'related_activity')->dropDownList(['prompt'=>Yii::t('app','--Activity--')])->label(false) : $form->field($model, 'related_activity')->dropDownList(\backend\models\ModuleActivity::getAll(),['prompt'=>Yii::t('app','--Activity--')])->label(false)?>
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
                <?=$model->isNewRecord ? $form->field($model, 'assigned_to')->dropDownList(['prompt'=>Yii::t('app','--Activity--')])->label(false) : $form->field($model, 'assigned_to')->dropDownList(\backend\models\Employee::getAll(),['prompt'=>Yii::t('app','--Activity--')])->label(false)?>
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
            <?= $form->field($model, 'related_department')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'department_related')->textInput(['placeholder'=>'related department','readonly'=>'readonly'])->label(false) ?>
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
            <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-4 pull-right">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '<i class="fa fa-save"></i>') : Yii::t('app', '<i class="fa fa-save"></i> Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary']) ?>
            </div>
            </div>
        </div>
    </div>




    <?php ActiveForm::end(); ?>

</div>

