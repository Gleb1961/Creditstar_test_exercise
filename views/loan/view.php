<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Loan */

$this->title = $model->loanId;
$this->params['breadcrumbs'][] = ['label' => 'Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="loan-view">

    <h1>Loan <?= Html::encode($this->title) ?></h1>

    <div class="view-block">

        <p>
            <?= Html::a('Update', ['update', 'id' => $model->loanId], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->loanId], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'loanId',
                [
                    'label' => 'User ID',
                    'format' => 'raw',
                    'value' => Html::a($model->userId, ['user/view', 'id' => $model->userId]),
                ],
                [
                    'label' => 'Personal Code',
                    'value' => $user->personalCode,
                ],
                [
                    'label' => 'First Name',
                    'value' => $user->firstName,
                ],
                [
                    'label' => 'Last Name',
                    'value' => $user->lastName,
                ],
                'amount',
                'interest',
                'duration',
                [
                    'attribute' => 'dateApplied',
                    'format' => ['date', 'php:d.m.Y']
                ],
                [
                    'attribute' => 'dateLoanEnds',
                    'format' => ['date', 'php:d.m.Y']
                ],
                'campaign',
                'status',
                'isDeleted:boolean',
            ],
        ]) ?>

    </div>

</div>
