<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\CategoryManagment;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product List';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-managment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
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

             ['class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'width: 12%'],
                'template' => '{BuyNow}',
                 'buttons' => [
                                            
                                    'BuyNow' => function ($url, $model) {
                                                 $t =  yii::$app->request->baseUrl."/productlist/view?id=" . $model['id'];
                                                return Html::a('<a class="btn btn-success" href="'.$t.'">Buy Now</a>', $t, ['title' => 'Buy Now']);
                                            },
                                                  
                                                ],
                                            
            ]
        ],
    ]); ?>


</div>
