<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BannerMain */

$this->title = 'Редагування банеру';
$this->params['breadcrumbs'][] = ['label' => 'Банери головної сторінки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагування';
?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <div class="banner-main-update">
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
