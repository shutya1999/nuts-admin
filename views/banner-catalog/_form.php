<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;


/* @var $this yii\web\View */
/* @var $model app\models\BannerMain */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-main-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'desktop')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'tablet')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_desktop')->widget(FileInput::class, [
        'options' => [
            'accept' => 'image/*',
            'id' => 'banner-main-desktop'
        ],
        'pluginOptions' => [
            'initialPreview' => !$model->isNewRecord ? $model->imagesLinks($model->desktop) : [],
            'initialPreviewConfig' => !$model->isNewRecord  ? $model->imagesLinksData($model->desktop, $model->id) : [],
            'initialPreviewAsData'=>true,
            'overwriteInitial'=>true,
            'allowedFileExtensions'=>['jpg', 'png', 'jpeg'],
            'showCaption' => false,
            'showUpload' => false
        ]
    ])->label("Зображення для комп'ютерів * (1200 х 400)"); ?>

    <?= $form->field($model, 'file_tablet')->widget(FileInput::class, [
        'options' => [
            'accept' => 'image/*',
            'id' => 'banner-main-tablet'
        ],
        'pluginOptions' => [
            'initialPreview' => !$model->isNewRecord ? $model->imagesLinks($model->tablet) : [],
            'initialPreviewConfig' => !$model->isNewRecord  ? $model->imagesLinksData($model->tablet, $model->id) : [],
            'initialPreviewAsData'=>true,
            'overwriteInitial'=>true,
            'allowedFileExtensions'=>['jpg', 'png', 'jpeg'],
            'showCaption' => false,
            'showUpload' => false
        ]
    ])->label("Зображення для планшетів * (720 х 400)"); ?>

    <?= $form->field($model, 'file_mob')->widget(FileInput::class, [
        'options' => [
            'accept' => 'image/*',
            'id' => 'banner-main-mobile'
        ],
        'pluginOptions' => [
            'initialPreview' => !$model->isNewRecord ? $model->imagesLinks($model->mobile) : [],
            'initialPreviewConfig' => !$model->isNewRecord  ? $model->imagesLinksData($model->mobile, $model->id) : [],
            'initialPreviewAsData'=>true,
            'overwriteInitial'=>true,
            'allowedFileExtensions'=>['jpg', 'png', 'jpeg'],
            'showCaption' => false,
            'showUpload' => false
        ]
    ])->label("Зображення для телефонів * (365 х 400)"); ?>


    <div class="form-group">
        <?= Html::submitButton('Зберегти', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
