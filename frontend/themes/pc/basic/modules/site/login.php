<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">

    <div class="mtx row">
	
		<h1><?= Html::encode($this->title) ?></h1>
	
        <div class="login">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

				<div class="loginform-username">
				<label class="control-label" for="loginform-username">用户名</label>
				<input type="text" id="loginform-username" class="form-control" name="LoginForm[username]" autofocus="" aria-required="true">
				</div>

				<div class="loginform-password">
				<label class="control-label" for="loginform-password">密码</label>
				<input type="password" id="loginform-password" class="form-control" name="LoginForm[password]" aria-required="true">
				</div>

				<div class="loginform-rememberme">
				<div class="checkbox">
				<label class="control-label" for="loginform-rememberme">
				<input type="hidden" name="LoginForm[rememberMe]" value="0"><input type="checkbox" id="loginform-rememberme" name="LoginForm[rememberMe]" value="1" checked="">
				记住
				</label>
				</div>
				</div>
			
                <div class="form-group">
                  <button type="submit" class="login-btn" name="login-button">登录</button>
				</div>
				
				<div class="forget">忘记密码? <a href="/site/request-password-reset">重置</a></div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
