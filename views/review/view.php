<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Reviews */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Відгуки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<style>
    .checked {
        color: orange;
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
                        'confirm' => 'Ви впевнені що хочете видалити відгук ?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
            <div class="box-body">
                <div class="reviews-view">

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            [
                                'attribute' => 'product_id',
                                'value' => function($data){
                                    return $data->product->title;
                                },
                                'format' => 'raw'
                            ],
                            'name',
                            //'rating',
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
                            'phone',
                            'created_at',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
