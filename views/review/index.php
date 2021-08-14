<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Відгуки';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .checked {
        color: orange;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <div class="reviews-index">

                    <h1><?= Html::encode($this->title) ?></h1>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
//                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id',
                            [
                                'attribute' => 'product_id',
                                'value' => function($data){
                                    return $data->product->title;
                                },
                                'format' => 'raw'
                            ],
                            'name',
                            [
                                'attribute' => 'rating',
                                'value' => function($data){
                                    $star = '';
                                    for ($i = 0; $i < 5; $i++){
                                        if ($i < $data->rating){
                                            $star .= '<span class="fa fa-star checked"></span>';
                                        }else{
                                            $star .= '<span class="fa fa-star"></span>';
                                        }
                                    }
                                    return "<div style='width: 70px'>$star</div>";
                                },
                                'format' => 'raw'
                            ],
                            'text:ntext',
                            //'phone',
                            [
                                'attribute' => 'created_at',
                                'value' => function($data){
                                    return "<div style='width: 70px'>$data->created_at</div>";
                                },
                                'format' => 'raw'
                            ],
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>

