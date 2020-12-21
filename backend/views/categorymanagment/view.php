<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CategoryManagment */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Category Managments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="category-managment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'name',
            [
                    'attribute' => 'created_date',
                    'label' => 'Created Date',
                    'filter'=>false,
                    'headerOptions' => ['style' => 'width: 20%'],
                    'value' => function ($data) {

                        return date("d-m-Y", strtotime($data['created_date']));
                    }
                ],
                [
                    'attribute' => 'updated_date',
                    'filter'=>false,
                    'label' => 'Updated Date',
                    'headerOptions' => ['style' => 'width: 20%'],
                    'value' => function ($data) {

                        return date("d-m-Y", strtotime($data['updated_date']));
                    }
                ],
        ],
    ]) ?>

</div>
