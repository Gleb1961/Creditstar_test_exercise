<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'firstName')->textInput(['style' => 'width: 400px', 'maxlength' => 255]) ?>

    <?= $form->field($model, 'lastName')->textInput(['style' => 'width: 400px', 'maxlength' => 255]) ?>

    <?= $form->field($model, 'email')->textInput(['style' => 'width: 400px', 'maxlength' => 255]) ?>

    <?= $form->field($model, 'personalCode')->textInput(['style' => 'width: 150px', 'maxlength' => 11]) ?>

    <?= $form->field($model, 'phone')->textInput(['style' => 'width: 150px', 'maxlength' => 20]) ?>

    <?= $form->field($model, 'lang')->textInput(['style' => 'width: 50px', 'maxlength' => 3]) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'isDead')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
