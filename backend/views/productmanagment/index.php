<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\CategoryManagment;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductManagmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Managments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-managment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product Managment', ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'category_id',
                'label' => 'Category Name',
                'filter' => false,
                'value' => function ($data) {
                    $catName = CategoryManagment::find()->select('name')->where(['id'=>$data->category_id])->one();
                    return $catName['name'];
                }],
            [
                    'attribute' => 'product_image',
                    'filter' => false,
                    'format' => 'raw',
                    'value' => function ($data) {
                        if (isset($data['product_image']) && !empty($data['product_image']) && $data['product_image'] != '') {
                            $path = SITE_ABS_UPLOAD_PATH . $data['product_image'];
                            

                            $imageVal = '<a download="' . SITE_ABS_UPLOAD_PATH .  $data['product_image'] . '" href="' . $path . '"><img height="84px" width="94px" src="' . $path . '" ></a>';
                        } else {
                            $imageVal = '<img height="84px" width="94px" src="' . SITE_ABS_UPLOAD_PATH . 'blank.png" >';
                        }
                        return $imageVal;
                    }
                ],
            
          [
                    'attribute' => 'price',
                 
                    'headerOptions' => ['style' => 'width: 20%'],
                    'value' => function ($data) {

                        return $data->price. " Rs.";
                    } 
                ],
            //'created_date',
            //'updated_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
