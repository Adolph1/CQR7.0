<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\EmailService */

$this->title = Yii::t('app', 'Create Email Service');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Email Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-service-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
