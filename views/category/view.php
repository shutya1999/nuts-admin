<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Категорії', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Ви точно хочете видалити категорію?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
            <div class="box-body">
                <div class="category-view">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'name',
                            'url:url',
                            'description',
                            'keywords',
                            [
                                'attribute'=>'img',
                                'value' => Yii::$app->components['siteURL'] . "/img/index/" . $model->img,
                                'format' => ['image',['width'=>'100','height'=>'auto']],
                            ],
                            [
                                'attribute' => 'is_main',
                                'value' => $model->is_main ? '<span class="text-green">Так</span>' : '<span class="text-red">Ні</span>',
                                'format' => 'raw',
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
