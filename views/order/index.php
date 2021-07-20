<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список замовлень';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="box">
<!--            <div class="box-header with-border">-->
<!--                --><?//= Html::a('Добавить заказ', ['create'], ['class' => 'btn btn-success']) ?>
<!--            </div>-->
            <div class="box-body">
                <div class="order-index">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id',
                            //'created_at',
                            [
                                'attribute' => 'created_at',
                                'format' => 'date',
                            ],
                            'qty',
                            'total',
                            'name',
                            'phone',
                            'delivery_type',
                            'payment_type',
                            'status:boolean',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Действия',
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>

