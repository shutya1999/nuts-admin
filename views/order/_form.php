<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => "
               <div class='col-md-6'>
                   <p>{label}</p> \n {input} \n
                   <div>{error}</div>
               </div>  
            ",
        ]
    ]); ?>

    <?= $form->field($model, 'status')->dropDownList(['Нове замовлення', 'Оброблено']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'payment_type')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'payment_type')->dropDownList([
        'Оплата при отриманні' => 'Оплата при отриманні',
        'LiqPay' => 'LiqPay',
    ])  ?>


    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'delivery_type')->dropDownList([
        'Нова Пошта' => 'Нова Пошта',
        'Укрпошта' => 'Укрпошта',
        'Кур’єрська доставка' => 'Кур’єрська доставка',
        'Самовивіз' => 'Самовивіз',
    ])  ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'department_np')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'index_ukr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'house_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apartment_number')->textInput(['maxlength' => true]) ?>

    <div style="display: flex; justify-content: center" class="form-group col-md-12">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success col-md-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
