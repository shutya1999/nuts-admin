<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Користувачі';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <div class="clients-index">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id',
                            [
                                'attribute' => 'username',
                                'value' => function($data){
                                    return "<a href='mailto:$data->username'>$data->username</a>";
                                },
                                'format' => 'raw'
                            ],
                            'name',
                            'surname',
                            [
                                'attribute' => 'phone',
                                'value' => function($data){
                                    return "<a href='tel:$data->phone'>$data->phone</a>";
                                },
                                'format' => 'raw'
                            ],
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
                <?= Html::a('Згенерувати файл для розсилки', ['generate-csv'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
</div>