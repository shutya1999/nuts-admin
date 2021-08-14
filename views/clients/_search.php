<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ClientSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clients-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'password') ?>

    <?= $form->field($model, 'auth_key') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'surname') ?>

    <?php // echo $form->field($model, 'patronymic') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'delivery_type') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'department_np') ?>

    <?php // echo $form->field($model, 'street') ?>

    <?php // echo $form->field($model, 'index_ukr') ?>

    <?php // echo $form->field($model, 'house_number') ?>

    <?php // echo $form->field($model, 'apartment_number') ?>

    <?php // echo $form->field($model, 'secret_key') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
