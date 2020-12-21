<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'User Registration';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to Registration:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                                   <div class="box-body">   
                        <div class="form-group">
                            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="form-group">    
                            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="form-group">    
                            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="form-group">    
                            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
                        </div>

                        <div class="form-group">    
                            <?= $form->field($model, 'profile_pic')->fileInput(['maxlength' => true]) ?>
                        </div>
                       
                      
                    </div>
                    <div class="box-footer">
                        <?= Html::submitButton('Submit', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
