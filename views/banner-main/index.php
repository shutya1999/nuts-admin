<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Банери для головної сторінки';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <?= Html::a('Додати банер', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
            <div class="box-body">
                <div class="banner-main-index">


                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            [
                                'class' => 'yii\grid\SerialColumn',
                            ],
                            [
                                'attribute' => 'desktop',
                                'format' => 'html',
                                'value' => function ($data) {
                                    return Html::img(Yii::getAlias(Yii::$app->components['siteURL']) . '/img/banner-main/' . '/' . $data['desktop'],
                                        ['width' => '300px']);
                                },
                            ],
                            [
                                'attribute' => 'tablet',
                                'format' => 'html',
                                'value' => function ($data) {
                                    return Html::img(Yii::getAlias(Yii::$app->components['siteURL']) . '/img/banner-main/' . '/' . $data['tablet'],
                                        ['width' => '300px']);
                                },
                            ],
                            [
                                'attribute' => 'mobile',
                                'format' => 'html',
                                'value' => function ($data) {
                                    return Html::img(Yii::getAlias(Yii::$app->components['siteURL']) . '/img/banner-main/' . '/' . $data['mobile'],
                                        ['width' => '200px']);
                                },
                            ],
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
