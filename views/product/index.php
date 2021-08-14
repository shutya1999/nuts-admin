<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товари';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <?= Html::a('Додати товар', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
            <div class="box-body">
                <div class="product-index">

                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'headerOptions' => ['width' => '70'],
                                'attribute' => 'id',
                            ],
                            [
                                'attribute' => 'category_id',
                                'value' => function($data){
                                    return $data->category->name;
                                }
                            ],
                            'title',
                            //'content:ntext',
                            //'price',
                            [
                                'attribute' => 'price',
                                'value' => function($data){
                                    return $data->price . ' грн';
                                },
                                'format' => 'raw'
                            ],
                            //'new_price',
                            [
                                'attribute' => 'new_price',
                                'value' => function($data){
                                    return $data->new_price . ' грн';
                                },
                                'format' => 'raw'
                            ],
                            [
                                'attribute' => 'sale',
                                'value' => function($data){
                                    return $data->sale . ' %';
                                },
                                'format' => 'raw'
                            ],
                            //'description',
                            //'keywords',
                            [
                                'attribute' => 'img',
                                'format' => 'html',
                                'value' => function ($data) {
                                    return Html::img(Yii::getAlias(Yii::$app->components['siteURL']).'/img/product/'. $data['url'] . '/' .$data['img'],
                                        ['width' => '70px']);
                                },
                            ],
                            [
                                'headerOptions' => ['width' => '35'],
                                'attribute' => 'rating',
                            ],
                            //'option:ntext',
                            'number_orders',
                            //'url:url',
                            'is_offer:boolean',
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>

