<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Всі продукти', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<style>
    .img-wrap img{
        margin: 0 10px;
    }
    .img-wrap img:first-child{
        margin-left: 0;
    }
    .img-wrap img:last-child{
        margin-right: 0;
    }
    .table-head{
        display: grid;
        grid-template-columns: repeat(3, 100px);
    }
    .table-head p{
        background: #ddd;
        margin: 0;
        padding: 10px 5px;
    }
    .table-body{
        display: grid;
        grid-template-columns: repeat(3, 100px);
    }
    .table-body p:nth-child(6n+4),
    .table-body p:nth-child(6n+5),
    .table-body p:nth-child(6n+6)
    {
        background: #ffe7b1;
    }
    .table-body p{
        margin: 0;
        padding: 5px 5px;
        background: #f9f9f9;
    }

</style>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Ви впевнені що хочете видалити товар ?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>

            <?php
            //Генерация цен
            $options = json_decode($model->option);
            $priceRow = '';

            foreach (current($options) as $key => $option) {
                $priceRow .= "<p>" . "$option->price грн " . "</p>" .
                             "<p>" . "$option->new_price грн " . "</p>" .
                             "<p>" . $option->quantity . "(" .  key($options) . ")" . "</p>";
            }

            //генерация изображений
            $dir = '/www/nuts-city.yh-web.space/web/img/product/' . $model->url;

            $ftp_server = 'leaf.cityhost.com.ua';
            $ftp_user_name = 'ch2e38aa18';
            $ftp_user_pass = 'a9c3ec2cc8';
            // установка соединения
            $conn_id = ftp_connect($ftp_server);
            $images = ftp_nlist($conn_id, '.');
            $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

            $images = ftp_mlsd ($conn_id, $dir);
            $imgRow = '';

            foreach ($images as $image){
                if ($image['name'] != '.' && $image['name'] != ".."){
                    $imgRow .=  Html::img(Yii::$app->components['siteURL'] . "/img/product/" . $model->url . '/' . $image['name'], ['width' => 100]);
                }
            }
            ?>


            <div class="box-body">
                <div class="product-view">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            [
                                'attribute' => 'category_id',
                                'value' => function($data){
                                    return $data->category->name;
                                }
                            ],
                            'title',
                            'content_lil:html',
                            'content_big:html',
                            //'price',
                            [
                                'attribute' => 'price',
                                'value' => $model->price . ' грн',
                                'format' => 'raw'
                            ],
                            [
                                'attribute' => 'new_price',
                                'value' => $model->new_price . ' грн',
                                'format' => 'raw'
                            ],
                            [
                                'attribute' => 'sale',
                                'value' => $model->sale . ' %',
                                'format' => 'raw'
                            ],
                            'description',
                            'keywords',
                            [
                                'attribute'=>'img',
                                'value' => Yii::$app->components['siteURL'] . "/img/product/" . $model->url . '/' . $model->img,
                                'format' => ['image',['width'=>'100','height'=>'auto']],
                            ],
                            //'is_offer',
                            [
                                'attribute' => 'is_offer',
                                'value' => $model->is_offer ? '<span class="text-green">Так</span>' : '<span class="text-red">Ні</span>',
                                'format' => 'raw',
                            ],
                            'rating',
                            [
                                'attribute' => 'option',
                                'value' => "
                                            <div class='table-price'>
                                                <div class='table-head'>
                                                    <p>Ціна</p>
                                                    <p>Нова ціна</p>
                                                    <p>Об'єм</p>
                                                </div>
                                                <div class='table-body'>$priceRow</div>
                                            </div>",
                                'format' => 'raw'
                            ],
                            'number_orders',
//                            'url:url',
                            [
                                'attribute' => 'url',
                                'value' => function($data){
                                    return Html::a(Html::encode($data->url),
                                        Yii::$app->components['siteURL'] . "/product/" . $data->url,
                                        ['target' => "_blank"]
                                    );
                                },
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'files',
                                'value' => "<div class='img-wrap'>$imgRow</div>",
                                'format' => 'raw'
                            ],
                        ],
                    ]) ?>

                </div>
            </div>
        </div>
    </div>
</div>

