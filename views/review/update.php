<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Reviews */

$this->title = 'Редагування товару: ' . "<strong>" . $model->product->title . "</strong>";
$this->params['breadcrumbs'][] = ['label' => 'Відгуки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагування';
?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <div class="product-update">

                    <div class="reviews-update">

                        <?= $this->render('_form', [
                            'model' => $model,
                        ]) ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
