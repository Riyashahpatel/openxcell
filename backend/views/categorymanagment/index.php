<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategoryManagmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Category Managments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-managment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Category Managment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
                    'label' => 'Updated Date',
                    'filter'=>false,
                    'headerOptions' => ['style' => 'width: 20%'],
                    'value' => function ($data) {

                        return date("d-m-Y", strtotime($data['updated_date']));
                    }
                ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
