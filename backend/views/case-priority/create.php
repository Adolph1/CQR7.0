<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CasePriority */

$this->title = Yii::t('app', 'Create Case Priority');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Case Priorities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="case-priority-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
