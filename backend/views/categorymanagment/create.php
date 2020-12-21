<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CategoryManagment */

$this->title = 'Create Category Managment';
$this->params['breadcrumbs'][] = ['label' => 'Category Managments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-managment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
