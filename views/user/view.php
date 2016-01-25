<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->userId;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-view">

    <h1>User <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->userId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->userId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this user?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Create Loan', ['loan/create', 'userId' => $model->userId], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'userId',
            'personalCode',
            'firstName:ntext',
            'lastName:ntext',
            [
                'label' => 'Age',
                'value' => $userAge,
            ],
            'email:ntext',
            'phone',
            'active:boolean',
            'isDead:boolean',
            'lang:ntext',
            [
                'label' => 'Loans count',
                'format' => 'raw',
                'value' => Html::a(count($loans), ['loan/index', 'LoanSearch[userId]' => $model->userId]),
            ],
        ],
    ]) ?>

</div>
