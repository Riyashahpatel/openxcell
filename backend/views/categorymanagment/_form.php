<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CategoryManagment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-managment-form">

    <?php $form = ActiveForm::begin(); ?>
         <div class="form-group">
         	<div class="col-md-6">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
         		
         	</div>

</div>
    <div class="form-group">
    	
<div class="col-md-6">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>

</div>
