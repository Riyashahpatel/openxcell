<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\CategoryManagment;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\ProductManagment */
/* @var $form yii\widgets\ActiveForm */
$categorydata =  CategoryManagment::find()->select('name,id')->orderby('name ')->all();
?>

<div class="product-managment-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">

            <?=  $form->field($model, 'category_id', [
                'template' => '<label>Category <span style="color:red;">*</span></label>{input}{error}'
            ])->dropDownList(ArrayHelper::map($categorydata, 'id', 'name'), ['prompt' => 'Please Select'])
           ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'product_image')->fileInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-6">
            <?php  if (!empty($model->product_image) && Yii::$app->controller->action->id == 'update') {
                 $path = SITE_ABS_UPLOAD_PATH . $model->product_image;
                            

                 $imageVal = '<a download="' . SITE_ABS_UPLOAD_PATH .$model->product_image . '" href="' . $path . '"><img height="84px" width="94px" src="' . $path . '" ></a>';
                 echo $imageVal;
            }?>
        </div>
        <div class="col-md-6">
         </div>
        <div class="col-md-6">
            <?= $form->field($model, 'price')->textInput() ?>
        </div>

        <div class="form-group">

            <div class="col-md-6">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
