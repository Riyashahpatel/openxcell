<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
 <div class="box-body">   
                        <div class="form-group">
                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>
                 <?= $form->field($model, 'is_admin')->hiddenInput(['value'=>'1'])->label(false) ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>
</div>
                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
</div>

<style type="text/css">
     .btn-block{
        width: 50%;
        align-content: center;
    }
    .form-control{
        width: 50%;
        align-content: center;
    }

  

</style>