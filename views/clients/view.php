<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Clients */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Клієнти', 'url' => ['index']];
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
                        'confirm' => 'Ви впевнені що хочее видалити користувача?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
            <div class="clients-view">

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'username',
                        'name',
                        'surname',
                        [
                            'attribute' => 'patronymic',
                            'visible' => !empty($model->patronymic)
                        ],
                        'phone',
                        [
                            'attribute' => 'delivery_type',
                            'visible' => !empty($model->delivery_type)
                        ],
                        [
                            'attribute' => 'city',
                            'visible' => !empty($model->city)
                        ],
                        [
                            'attribute' => 'department_np',
                            'visible' => !empty($model->department_np)
                        ],
                        [
                            'attribute' => 'street',
                            'visible' => !empty($model->street)
                        ],
                        [
                            'attribute' => 'index_ukr',
                            'visible' => !empty($model->index_ukr)
                        ],
                        [
                            'attribute' => 'house_number',
                            'visible' => !empty($model->house_number)
                        ],
                        [
                            'attribute' => 'apartment_number',
                            'visible' => !empty($model->apartment_number)
                        ],
                    ],
                ]) ?>

            </div>
