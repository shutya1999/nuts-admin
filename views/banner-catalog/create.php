<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BannerMain */

$this->title = 'Додавання банеру';
$this->params['breadcrumbs'][] = ['label' => 'Всі банери головної сторінки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <div class="banner-main-create">
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
