<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = "Замовлення № {$model->id}";
$this->params['breadcrumbs'][] = ['label' => 'Усі замовлення', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <?= Html::a('Оновити', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Ви впевнені що хочете видалити замовлення ?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
            <div class="box-body">
                <div class="order-view">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'created_at',
                            'updated_at',
                            'qty',
                            [
                                'attribute' => 'total',
                                'value' => $model->total . " грн",
                            ],
                            [
                                'attribute' => 'status',
                                'value' => $model->status ? '<strong class="text-green">Оброблено</strong>' : '<strong class="text-red">Новий</strong>',
                                'format' => 'raw',
                            ],
                            'name',
                            'email:email',
                            'phone',
                            'payment_type',
                            [
                                'attribute' => 'note',
                                'visible' => !empty($model->note),
                                'format' => 'ntext'
                            ],
                            'last_name',
                            [
                                'attribute' => 'consultation',
                                'value' => $model->consultation ? '<span class="text-green">Консультація потрібна</span>' : '<span class="text-red">Консультація не потрібна</span>',
                                'format' => 'raw',
                            ],
                            'delivery_type',
                            [
                                'attribute' => 'city',
                                'visible' => !empty($model->city)
                            ],
                            [
                                'attribute' => 'department_np',
                                'visible' => !empty($model->department_np),
                            ],
                            [
                                'attribute' => 'street',
                                'visible' => !empty($model->street),
                            ],
                            [
                                'attribute' => 'index_ukr',
                                'visible' => !empty($model->index_ukr),
                            ],
                            [
                                'attribute' => 'house_number',
                                'visible' => !empty($model->house_number),
                            ],
                            [
                                'attribute' => 'apartment_number',
                                'visible' => !empty($model->apartment_number),
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$items = $model->orderProduct;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Bordered Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th style="width: 10px">ID</th>
                            <th>Назва</th>
                            <th>Об'єм</th>
                            <th>Ціна за 1 шт</th>
                            <th>Кількість</th>
                            <th>Сума</th>
                        </tr>
                        <?php foreach ($items as $item) : ?>
                            <tr>
                                <td><?= $item->id ?></td>
                                <td><?= $item->title ?></td>
                                <td><?= $item->volume ?> <?= $item->volume_type ?></td>
                                <td><?= $item->price ?> грн</td>
                                <td><?= $item->qty ?> шт</td>
                                <td><?= $item->total ?> грн</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>