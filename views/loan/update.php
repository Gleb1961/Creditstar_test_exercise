<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Loan */

$this->title = 'Update Loan: ' . ' ' . $model->loanId;
$this->params['breadcrumbs'][] = ['label' => 'Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->loanId, 'url' => ['view', 'id' => $model->loanId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="loan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'showUserId' => $showUserId,
    ]) ?>

</div>
