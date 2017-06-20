<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CasePriority */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Case Priority',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Case Priorities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="case-priority-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
