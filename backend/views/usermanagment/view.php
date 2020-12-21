<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

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
            'first_name',
            'last_name',
            'email:email',
            // 'password',
            'profile_pic',
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

            [
                'attribute' => 'is_admin',
                'label' => 'User Type',
                'filter' => array("0" => "Normal", "1" => "Admin"),

                'headerOptions' => ['style' => 'width: 5%'],
                // 'filter' => false,
                'value' => function ($data) {
                    if($data['is_admin'] == 0) {
                        return "Normal";
                    }else{
                        return "Admin";
                    }
                    
                }],

                [
                    'attribute' => 'created_date',
                    'label' => 'Created Date',
                    'headerOptions' => ['style' => 'width: 20%'],
                    'value' => function ($data) {

                        return date("d-m-Y", strtotime($data['created_date']));
                    }
                ],
                [
                    'attribute' => 'updated_date',
                    'label' => 'Updated Date',
                    'headerOptions' => ['style' => 'width: 20%'],
                    'value' => function ($data) {

                        return date("d-m-Y", strtotime($data['updated_date']));
                    }
                ],
            ],
        ]) ?>

    </div>
