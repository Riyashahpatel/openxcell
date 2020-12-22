<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\ProductManagment;
use app\models\User;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderManagmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order History';
$this->params['breadcrumbs'][] = $this->title;
// p($dataProvider);
?>
<?php
                            $gridColumn = [
                                ['class' => 'yii\grid\SerialColumn'],
                              //  ['attribute' => 'id', 'visible' => false],
                                [
                                    'attribute' => 'product_id',
                                    'label' => 'Product Name',
                                    // 'headerOptions' => ['style' => 'width: 20%'],
                                    'value' => function ($data) {
                                        $pname = ProductManagment::find()->select('name')->where(['id'=>$data->product_id])->one();
                                        return $pname['name'];
                                    }
                                ],
                                [
                                    'attribute' => 'user_id',
                                    'label' => 'User Name',
                                    // 'headerOptions' => ['style' => 'width: 20%'],
                                    'value' => function ($data) {
                                        $pname = User::find()->select('first_name')->where(['id'=>$data->user_id])->one();
                                        return $pname['first_name'];
                                    }
                                ],
                                 [
                    'attribute' => 'created_date',
                    'label' => 'Created Date',
                    'headerOptions' => ['style' => 'width: 20%'],
                    'value' => function ($data) {

                        return date("d-m-Y", strtotime($data['created_date']));
                    }
                ],
                               
                            ];


                            $expgridColumn = [
                                ['class' => 'yii\grid\SerialColumn'],
                                 //  ['attribute' => 'id', 'visible' => false],
                                [
                                    'attribute' => 'product_id',
                                    'label' => 'Product Name',
                                    // 'headerOptions' => ['style' => 'width: 20%'],
                                    'value' => function ($data) {
                                        $pname = ProductManagment::find()->select('name')->where(['id'=>$data->product_id])->one();
                                        return $pname['name'];
                                    }
                                ],
                                [
                                    'attribute' => 'user_id',
                                    'label' => 'User Name',
                                    // 'headerOptions' => ['style' => 'width: 20%'],
                                    'value' => function ($data) {
                                        $pname = User::find()->select('first_name')->where(['id'=>$data->user_id])->one();
                                        return $pname['first_name'];
                                    }
                                ],
                                 [
                    'attribute' => 'created_date',
                    'label' => 'Created Date',
                    'headerOptions' => ['style' => 'width: 20%'],
                    'value' => function ($data) {

                        return date("d-m-Y", strtotime($data['created_date']));
                    }
                ],
                                                      ]; ?>
                                                           <?=
                            GridView::widget([
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'columns' => $gridColumn,
                                'pjax' => false,
                                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-tpcreceipt']],
                                'panel' => [
                                    'type' => GridView::TYPE_PRIMARY,
                                    'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
                                ],
                                // your toolbar can include the additional full export menu
                                'toolbar' => [
//                                                                            '{export}',
                                    ExportMenu::widget([
                                        'dataProvider' => $dataProvider,
                                        'columns' => $expgridColumn,
                                        'target' => ExportMenu::TARGET_BLANK,
                                        'fontAwesome' => true,
                                        'dropdownOptions' => [
                                            'label' => "Export",
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
                                                      ];



                            ?>