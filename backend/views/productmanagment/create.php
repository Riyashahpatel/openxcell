<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductManagment */

$this->title = 'Create Product Managment';
$this->params['breadcrumbs'][] = ['label' => 'Product Managments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-managment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
