<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CustomerCase */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Customer Case',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customer Cases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="customer-case-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
