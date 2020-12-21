<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use backend\models\ProductManagment;
use app\models\User;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderManagmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order History';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-managment-index">

    <h1><?= Html::encode($this->title) ?></h1>

   

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
 <?php $gridColumn = [
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
             ['class' => 'yii\grid\SerialColumn'],
             [
                            'class' => 'kartik\grid\ExpandRowColumn',
                            'width' => '50px',
                            'value' => function ($model, $key, $index, $column) {
                                return GridView::ROW_COLLAPSED;
                            },
                            'detail' => function ($model, $key, $index, $column) {
                                return Yii::$app->controller->renderPartial('_expand', ['model' => $model]);
                            },
                                    'headerOptions' => ['class' => 'kartik-sheet-style'],
                                    'expandOneOnly' => true
                                ],
            // 'id',
            [
                'attribute' => 'product_id',
                'label' => 'Product Name',
                'filter' => false,
                'value' => function ($data) {
                   
                    $catName = ProductManagment::find()->select('name')->where(['id'=>$data->product_id])->one();
                    return $catName['name'];
                }],
                [
                'attribute' => 'user_id',
                'label' => 'User Name',
                'filter' => false,
                'value' => function ($data) {
                   
                    $Name = User::find()->select('first_name,last_name')->where(['id'=>$data->user_id])->one();
                  // p($Name['first_name']);
                    return !empty($Name['first_name'])?$Name['first_name']:'';
                }],
            
           [
                    'attribute' => 'created_date',
                    'label' => 'Created Date',
                    'filter' => false,
                    'headerOptions' => ['style' => 'width: 20%'],
                    'value' => function ($data) {

                        return date("d-m-Y", strtotime($data['created_date']));
                    }
                ],

                
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]; 
                                    $exportGridColumn = [
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\Module'],

            // 'id',
            [
                'attribute' => 'product_id',
                'label' => 'Product Name',
                'filter' => false,
                'value' => function ($data) {
                   
                    $catName = ProductManagment::find()->select('name')->where(['id'=>$data->product_id])->one();
                    return $catName['name'];
                }],
                [
                'attribute' => 'user_id',
                'label' => 'User Name',
                'filter' => false,
                'value' => function ($data) {
                   
                    $Name = User::find()->select('first_name,last_name')->where(['id'=>$data->user_id])->one();
                  // p($Name['first_name']);
                    return !empty($Name['first_name'])?$Name['first_name']:'';
                }],
            
           [
                    'attribute' => 'created_date',
                    'label' => 'Created Date',
                    'filter' => false,
                    'headerOptions' => ['style' => 'width: 20%'],
                    'value' => function ($data) {

                        return date("d-m-Y", strtotime($data['created_date']));
                    }
                ],

                
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]; ?>
    <?=
                                    GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        'filterModel' => $searchModel,
                                        'columns' => $gridColumn,
                                       
                                        'pjax' => false,
                                        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-complaint']],
                                        'panel' => [
                                            'type' => GridView::TYPE_PRIMARY,
                                            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
                                        ],
                                        // your toolbar can include the additional full export menu
                                        'toolbar' => [
//                                            '{export}',
                                            ExportMenu::widget([
                                                'dataProvider' => $dataProvider,
                                                'columns' => $exportGridColumn,
                                                'target' => ExportMenu::TARGET_BLANK,
                                                'fontAwesome' => true,
                                                'dropdownOptions' => [
                                                    'label' => 'Export',
                                                    'class' => 'btn btn-default',
                                                    'itemsBefore' => [
                                                        '<li class="dropdown-header">Export All Data</li>',
                                                    ],
                                                ],
                                                'exportConfig' => [
                                                    ExportMenu::FORMAT_TEXT => false,
                                                    ExportMenu::FORMAT_PDF => false,
                                                    ExportMenu::FORMAT_HTML => false,
                                                    ExportMenu::FORMAT_CSV => false
                                                ]
                                            ]),
                                        ],
                                    ]);
                                    ?>


</div>
