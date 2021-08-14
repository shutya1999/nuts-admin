<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use kartik\file\FileInput;
use yii\helpers\Url;
use yii\web\View;


//$this->registerJsFile("@web/js/product.js");

$this->registerJsFile('@web/js/product.js', ['depends' => \app\assets\AppAsset::class]);


/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
    #cke_2_contents{
        height: 500px!important;
    }
    .price{
        padding: 0;
    }
    .price__select{
        display: flex;
        margin-bottom: 30px;
    }
    .price__select .form-check{
        margin-right: 25px;
    }
    .form-btn{
        display: flex;
        justify-content: center;
    }
</style>


<?php
//echo "<pre>";
//var_dump($model);
//echo "</pre>";
//?>

<?php
if(isset($model->option)){
    $options = json_decode($model->option);
    $res = '';
    switch (key($options)){
        case 'Грам';
            foreach (current($options) as $key => $option){
                $res .= "
                    <div class=\"form-group _price col-md-3\" >
                        <label class=\"control-label\" for=\"price-$key\">Ціна за {$option->quantity} грам</label>
                        <input type=\"number\" id=\"price-$key\" class=\"form-control\" value='$option->price' name=\"price_{$option->quantity}\" data-volume = \"{$option->quantity}\">
                    </div>
                ";
            }
            break;
        case 'Кілограм';
            foreach (current($options) as $key => $option){
                $res .= "
                    <div class=\"form-group _price col-md-3\" >
                        <label class=\"control-label\" for=\"price-$key\">Ціна за {$option->quantity} кілограм</label>
                        <input type=\"number\" id=\"price-$key\" class=\"form-control\" value='$option->price' name=\"price_{$option->quantity}\" data-volume = \"{$option->quantity}\">
                    </div>
                ";
            }
            break;
        case 'Штук';
            foreach (current($options) as $key => $option){
                $res .= "
                    <div class=\"form-group _price col-md-3\" >
                        <label class=\"control-label\" for=\"price-$key\">Ціна за {$option->quantity} штуку</label>
                        <input type=\"number\" id=\"price-$key\" class=\"form-control\" value='$option->price' name=\"price_{$option->quantity}\" data-volume = \"{$option->quantity}\">
                    </div>
                ";
            }
            break;
        case 'Літр';
            foreach (current($options) as $key => $option){
                $res .= "
                    <div class=\"form-group _price col-md-3\" >
                        <label class=\"control-label\" for=\"price-$key\">Ціна за {$option->quantity} літр</label>
                        <input type=\"number\" id=\"price-$key\" class=\"form-control\" value='$option->price' name=\"price_{$option->quantity}\" data-volume = \"{$option->quantity}\">
                    </div>
                ";
            }
            break;
        case 'Box';
            $res = "
                <div class=\"form-group _price col-md-3\" >
                    <label class=\"control-label\" for=\"price-1\">Ціна за стандартну коробку</label>
                    <input type=\"number\" id=\"price-1\" class=\"form-control\" value = '{$options->Box[0]->price}'  name=\"price_200\" data-title = \"Стандарт (Картонна)\" data-volume = \"1\" autocomplete=\"off\">
                </div>
                <div class=\"form-group _price col-md-3\" >
                    <label class=\"control-label\" for=\"price-2\">Ціна за преміум коробку</label>
                    <input type=\"number\" id=\"price-2\" class=\"form-control\" value = '{$options->Box[1]->price}' name=\"price_200\" data-title = \"Преміум (Дерев'яна)\" data-volume = \"2\" autocomplete=\"off\">
                </div>
            ";
            break;
    }

}
?>

<?php
//echo "<pre>";
//var_dump($options->Box[0]->price);
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'form-product',
            'onsubmit' => 'return false;',
            'data-volume' => 'Грам'
        ]
    ]); ?>

    <?php $categories = \app\models\Category::find()->select(['name', 'id'])->asArray()->all(); ?>
    <?php
        $dataCat = [];
        $dataCat[''] = 'Оберіть категорію';
        foreach ($categories as $category){
            $dataCat[$category['id']] = $category['name'];
        }
    ?>

    <?= $form->field($model, 'category_id')->dropDownList($dataCat)->label('Категорія *'); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Назва товару *') ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true])->label('Посилання *') ?>

    <?= $form->field($model, 'price')->textInput()->label('Ціна *') ?>

    <?//= $form->field($model, 'old_price')->textInput()->label('Ціна без скидки') ?>

    <?= $form->field($model, 'sale')->textInput()->label('Знижка *') ?>

    <?= $form->field($model, 'option', ['template' => "{input}"])->hiddenInput() ?>

    <div class="price col-md-12">
        <p class="h4"><strong>Оберіть об'єм *</strong></p>
        <div class="price__select">
            <div class="form-check" >
                <input class="form-check-input" type="radio" value="Грами" id="grams" name="volume-type" checked>
                <label class="form-check-label" for="grams" >
                    Грами
                </label>
            </div>
            <div class="form-check" >
                <input class="form-check-input" type="radio" value="Кілограм" id="kilograms" name="volume-type" <?= (isset($model->option) && key($options) == 'Кілограм') ? 'checked' : '' ?>>
                <label class="form-check-label" for="kilograms">
                    Кілограми
                </label>
            </div>
            <div class="form-check" >
                <input class="form-check-input" type="radio" value="Літрів" id="liters" name="volume-type" <?= (isset($model->option) && key($options) == 'Літр') ? 'checked' : '' ?>>
                <label class="form-check-label" for="liters">
                    Літри
                </label>
            </div>
            <div class="form-check" >
                <input class="form-check-input" type="radio" value="Штук" id="count" name="volume-type" <?= (isset($model->option) && key($options) == 'Штук') ? 'checked' : '' ?>>
                <label class="form-check-label" for="count">
                    Штуки
                </label>
            </div>
            <div class="form-check" >
                <input class="form-check-input" type="radio" value="Штук" id="box" name="volume-type" <?= (isset($model->option) && key($options) == 'Box') ? 'checked' : '' ?>>
                <label class="form-check-label" for="box">
                    Коробка
                </label>
            </div>
        </div>
        <div class="price__content">
            <?php if(isset($model->option)): ?>
                <?= $res ?>
            <?php else: ?>
                <div class="form-group _price col-md-3" >
                    <label class="control-label" for="price-1">Ціна за 200 грам</label>
                    <input type="number" id="price-1" class="form-control" name="price_200" data-volume = "200">
                </div>

                <div class="form-group _price col-md-3">
                    <label class="control-label" for="price-2">Ціна за 300 грам</label>
                    <input type="number" id="price-2" class="form-control" name="price_300" data-volume = "300">
                </div>

                <div class="form-group _price col-md-3">
                    <label class="control-label" for="price-3">Ціна за 400 грам</label>
                    <input type="number" id="price-3" class="form-control" name="price_400" data-volume = "400">
                </div>

                <div class="form-group _price col-md-3">
                    <label class="control-label" for="price-4">Ціна за 500 грам</label>
                    <input type="number" id="price-4" class="form-control" name="price_500" data-volume = "500">
                </div>

                <div class="form-group _price col-md-3">
                    <label class="control-label" for="price-5">Ціна за 600 грам</label>
                    <input type="number" id="price-5" class="form-control" name="price_600" data-volume = "600">
                </div>

                <div class="form-group _price col-md-3">
                    <label class="control-label" for="price-6">Ціна за 700 грам</label>
                    <input type="number" id="price-6" class="form-control" name="price_700" data-volume = "700">
                </div>

                <div class="form-group _price col-md-3">
                    <label class="control-label" for="price-7">Ціна за 800 грам</label>
                    <input type="number" id="price-7" class="form-control" name="price_800" data-volume = "800">
                </div>

                <div class="form-group _price col-md-3">
                    <label class="control-label" for="price-8">Ціна за 900 грам</label>
                    <input type="number" id="price-8" class="form-control" name="price_900" data-volume = "900">
                </div>

                <div class="form-group _price col-md-3">
                    <label class="control-label" for="price-9">Ціна за 1000 грам</label>
                    <input type="number" id="price-9" class="form-control" name="price_1000" data-volume = "1000">
                </div>

                <div class="form-group _price _price col-md-3">
                    <label class="control-label" for="price-10">Ціна за 1500 грам</label>
                    <input type="number" id="price-10" class="form-control" name="price_1500" data-volume = "1500">
                </div>

                <div class="form-group _price col-md-3">
                    <label class="control-label" for="price-11">Ціна за 2000 грам</label>
                    <input type="number" id="price-11" class="form-control" name="price_2000" data-volume = "2000">
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?//= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'main_photo')->widget(FileInput::class, [
        'options' => [
            'accept' => 'image/*',
            'id' => 'file-input__main-photo'
        ],
        'pluginOptions' => [
            'initialPreview' => !$model->isNewRecord && $model->img ? Yii::$app->components['siteURL'] . "/img/product/" . $model->url . '/' . $model->img : [],
            'initialPreviewConfig' => [['key' => $model->img, 'url' => $model->url . '/' . $model->img]],
            'initialPreviewAsData'=>true,
            'overwriteInitial'=>true,
            'allowedFileExtensions'=>['jpg', 'png', 'jpeg'],
        ]
    ])->label('Головне зображення *'); ?>
    <?= $form->field($model, 'sec_photo')->widget(FileInput::class, [
        'options' => [
            'accept' => 'image/*',
            'id' => 'file-input__sec-photo'
        ],
        'pluginOptions' => [
            'initialPreview' => !$model->isNewRecord && $model->sec_img ? Yii::$app->components['siteURL'] . "/img/product/" . $model->url . '/' . $model->sec_img : [],
            'initialPreviewConfig' => [['key' => $model->sec_img, 'url' => $model->url . '/' . $model->sec_img]],
            'initialPreviewAsData'=>true,
            'overwriteInitial'=>true,
            'allowedFileExtensions'=>['jpg', 'png', 'jpeg'],
        ]
    ])->label('Додаткове зображення* (використовується при наведенні на товар)'); ?>

    <?= $form->field($model, 'files[]')->widget(FileInput::class, [
        'options' => [
            'multiple' => true,
            'accept' => 'image/*',
            'id' => 'file-input'
        ],
        'pluginOptions' => [
            //'initialPreview'=> (isset($model->files)) ? $model->files : '',

            'initialPreview' => !$model->isNewRecord ? $model->imagesLinks : [],
            'initialPreviewConfig' => !$model->isNewRecord  ? $model->imagesLinksData : [],
            'initialPreviewAsData'=>true,
            'overwriteInitial'=>true,
            'showUpload' =>false,
            'allowedFileExtensions'=>['jpg', 'png', 'jpeg'],

            'showCaption' => false,
            'showUpload' => false,
            'showRemove' => true,
            'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> '
        ]
    ])->label('Зображення *'); ?>

    <?= $form->field($model, 'is_offer')->dropDownList([
        'Товар не є спеціальною пропозицією (не показувати на головній)',
        'Це спеціальна пропозиція, показувати на головній'
    ])->label('Спеціальна пропозиція *') ?>

    <?= $form->field($model, 'content_lil')->widget(CKEditor::class,[
        'editorOptions' => [
            'preset' => 'basic', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ])->label('Короткий опис товару *');
    ?>

    <?= $form->field($model, 'content_big')->widget(CKEditor::class,[

        'editorOptions' => [
            'options' => ['rows' => 20],
            'preset' => 'basic', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
            'clientOptions' => ['rows' => 20],
        ],
        //'clientOptions' => ['rows' => 20]
    ])->label('Повний опис товару *');
    ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'rating')->textInput() ?>


    <?//= $form->field($model, 'number_orders')->textInput() ?>

    <div class="form-group form-btn">
        <?= Html::submitButton('Зберегти', ['class' => 'btn btn-success col-md-3']) ?>
    </div>



    <?php ActiveForm::end(); ?>
</div>


<?php
//
//$this->registerJs('
//  // #uploadsfiles-imagesfile - id Вашего FileInput
//  $("#file-input").on("fileuploaded", function(event, data, previewId, index) {
//  input.fileinput("destroy").fileinput({
//    multiple: true,
//    showUpload: false,
//    showRemove: false,
//    initialPreviewAsData: true,
//    overwriteInitial: false,
//    deleteUrl: "/product/del-img", // подставить реальный путь к действию
//    initialPreview: data.response.initialPreview,
//    initialPreviewConfig: data.response.initialPreviewData,
//  })
//  input.closest("form").find("button").attr("disabled", false)
//    console.log(data);
//});
//', View::POS_END);
//
//?>
