<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\CategoryManagment;
/* @var $this yii\web\View */
/* @var $model backend\models\ProductManagment */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Managments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-managment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
        ],
    ]) ?>

</div>
<div><?= Html::a('Buy Now', ['/productlist/checkout?id='.$model->id.''], ['class'=>'btn btn-primary']) ?>
</div>
