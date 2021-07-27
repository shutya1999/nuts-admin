<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use mihaildev\ckeditor\CKEditor;
?>

<div class="info-form">
    <?php $form = ActiveForm::begin([
    ]); ?>

    <?= $form->field($model, 'phone1')->textInput() ?>
    <?= $form->field($model, 'phone2')->textInput() ?>
    <?= $form->field($model, 'viber')->textInput() ?>
    <?= $form->field($model, 'telegram')->textInput() ?>
    <?= $form->field($model, 'instagram')->textInput() ?>
    <?= $form->field($model, 'facebook')->textInput() ?>
    <?= $form->field($model, 'address')->textInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>


    <div style="display: flex; justify-content: center" class="form-group col-md-12">
        <?= Html::submitButton('Зберегти', ['class' => 'btn btn-success col-md-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
