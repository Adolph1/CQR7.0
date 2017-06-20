<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CustomerCase */

$this->title = Yii::t('app', 'Create Customer Case');
?>
<div class="row">
    <div class="col-md-12">
        <h3 style="color: #003b4c;font-family: Tahoma"><i class="fa fa-server"></i><strong> NEW CASE</strong></h3>
    </div>
</div>
<hr>
<div class="row">
<div class="col-md-12">
    <?= $this->render('_form', [
        'model' => $model,'customer'=>$customer
    ]) ?>
</div>
</div>
