<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'first_name',
            'last_name',
            'email:email',
            [
                'attribute' => 'is_admin',
                'label' => 'User Type',
                'filter' => array("0" => "Normal", "1" => "Admin"),

                // 'headerOptions' => ['style' => 'width: 5%'],
                // 'filter' => false,
                'value' => function ($data) {
                    if($data['is_admin'] == 0) {
                        return "Normal";
                    }else{
                        return "Admin";
                    }
                }],
                [
                    'attribute' => 'profile_pic',
                    'filter' => false,
                    'format' => 'raw',
                    'value' => function ($data) {
                        if (isset($data['profile_pic']) && !empty($data['profile_pic']) && $data['profile_pic'] != '') {
                            $path = SITE_ABS_PATH_PROFILE_PICTURE . $data['profile_pic'];
                            

                            $imageVal = '<a download="' . SITE_ABS_PATH_PROFILE_PICTURE .  $data['profile_pic'] . '" href="' . $path . '"><img height="84px" width="94px" src="' . $path . '" ></a>';
                        } else {
                            $imageVal = '<img height="84px" width="94px" src="' . SITE_ABS_UPLOAD_PATH . 'imgavatar3.png" >';
                        }
                        return $imageVal;
                    }
                ],

                ['class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'width: 12%'],
                'template' => '{view}',
            ]
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
