<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BannerMain */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Головний банер', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="box-body">
                    <div class="banner-main-view">

                        <p>
                            <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Ви дійсно хочете видалити банер?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </p>

                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                [
                                    'attribute' => 'desktop',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        return Html::img(Yii::getAlias(Yii::$app->components['siteURL']) . '/img/banner-main/' . '/' . $model['desktop'],
                                            ['width' => '300px']);
                                    },
                                ],
                                [
                                    'attribute' => 'tablet',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        return Html::img(Yii::getAlias(Yii::$app->components['siteURL']) . '/img/banner-main/' . '/' . $model['tablet'],
                                            ['width' => '300px']);
                                    },
                                ],
                                [
                                    'attribute' => 'mobile',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        return Html::img(Yii::getAlias(Yii::$app->components['siteURL']) . '/img/banner-main/' . '/' . $model['mobile'],
                                            ['width' => '200px']);
                                    },
                                ],
                            ],
                        ]) ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
