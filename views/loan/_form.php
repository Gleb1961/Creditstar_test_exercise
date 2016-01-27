<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Loan */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="view-block loan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $sValue = Yii::$app->request->get('userId');

    if ($showUserId === true && !empty($sValue))
    {
        ?>
        <?= $form->field($model, 'userId')->textInput([
            'style' => 'width: 80px',
            'maxlength' => 20,
            'readonly' => 'readonly',
            'value' => $sValue
        ]) ?>
    <?php
    }
    else
    {
    ?>
    <?= $form->field($model, 'userId')->textInput([
        'style' => 'width: 80px',
    ]) ?>
    <?php
    }
    ?>

    <?= $form->field($model, 'amount')->textInput(['style' => 'width: 100px', 'maxlength' => 20]) ?>

    <?= $form->field($model, 'interest')->textInput(['style' => 'width: 100px', 'maxlength' => 20]) ?>

    <?= $form->field($model, 'duration')->textInput(['style' => 'width: 50px', 'maxlength' => 4]) ?>

    <?= $form->field($model, 'dateApplied')->textInput(['style' => 'width: 105px', 'maxlength' => 10]) ?>

    <?= $form->field($model, 'dateLoanEnds')->textInput(['type' => 'date', 'style' => 'width: 105px', 'maxlength' => 10]) ?>

    <?= $form->field($model, 'campaign')->textInput(['style' => 'width: 50px', 'maxlength' => 2]) ?>

    <?= $form->field($model, 'status')->textInput(['style' => 'width: 50px', 'maxlength' => 2]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
