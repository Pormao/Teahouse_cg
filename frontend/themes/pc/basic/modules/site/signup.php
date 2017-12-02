<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">

    <div class="row">
		<h1><?= Html::encode($this->title) ?></h1>
        <div class="mtx signup">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
			
				<div class="signupform-username">
				<label class="control-label" for="signupform-username">用户名</label>
				<input type="text" id="signupform-username" class="form-control" name="SignupForm[username]" autofocus="" aria-required="true">
				</div>
				
				<div class="signupform-email">
				<label class="control-label" for="signupform-email">Email</label>
				<input type="text" id="signupform-email" class="form-control" name="SignupForm[email]" aria-required="true">
				</div>
				
                <div class="signupform-password">
				<label class="control-label" for="signupform-password">密码</label>
				<input type="password" id="signupform-password" class="form-control" name="SignupForm[password]" aria-required="true">
				</div>
				
                <div class="form-group">
                    <button type="submit" class="signup-btn" name="signup-button">注册</button>
				</div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
