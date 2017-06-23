<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CaseStatus */

$this->title = Yii::t('app', 'Create Case Status');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Case Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="case-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
