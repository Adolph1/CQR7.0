<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CustomerCase */

$this->title = Yii::t('app', 'Update: ') .$model->title;
?>
<div class="customer-case-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,'customer'=>$customer
    ]) ?>

</div>
