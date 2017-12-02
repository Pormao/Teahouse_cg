<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\Web\View;

/* @var $this \yii\web\View */
/* @var $user \common\models\LoginForm */
/* @var $title string */
$this->registerJs('
document.getElementById("vcode_post").onclick = function(){
	var csrfToken = $('."'".'meta[name="csrf-token"]'."'".').attr("content");
	var vcode = document.getElementById("vcode_content").value;
	
	$.ajax({
	type: "POST",
	url:"'.$vcodePath.'/vcode",
	data:{
		"_csrf-frontend":csrfToken,
		vcode:vcode
		},
	success: function(data){
			  if(data.code == "success"){
				  closevcode();
			  }
			  if(data.code == "lose"){
				  alert("验证失败");
			  }
			  
			},
	dataType: "json"//返回数据的类型
	});  
}

function loadvcode(){
	vcodeloading(1);
	document.getElementById("captchaimg").click();
	document.getElementById("bg").style.display = "block";
	document.getElementById("vcode").style.display = "block";
}

function vcodeloading(status){
	if(status==1){
		document.getElementById("vcodeloading").style.display = \'block\';
		document.getElementById("vcodeloading").src = "/images/672.gif";
		document.getElementById("captchaimg").style.display = \'none\';
	}else{
		document.getElementById("vcodeloading").style.display = \'none\';
		document.getElementById("captchaimg").style.display = \'block\';
	}
}

document.getElementById(\'captchaimg\').onload = function(e){
	e.stopPropagation();
	vcodeloading(0);
}

function closevcode(){
	document.getElementById("bg").style.display = "none";
	document.getElementById("vcode").style.display = "none";
}

function checkvcode(){
	var csrfToken = $('."'".'meta[name="csrf-token"]'."'".').attr("content");
	var vdata = "";
	
	$.ajax({
	type: "POST",
	url:"'.$vcodePath.'/gvs",
	async:false, 
	data:{
		"_csrf-frontend":csrfToken
		},
	success: function(data){
		vdata = data;
			},
	dataType: "json"
	});
	
	return vdata;
}
', View::POS_END);

$this->registerCss('
.vcode {
    position: fixed;
    width: 250px;
    height: auto;
    background-color: #fff!important;
    box-shadow: 0px 0px 150px #8f9192;
    left: 50%;
    margin-left: -125px;
    top: 50%;
    margin-top: -100px;
    z-index: 999;
    padding: 20px!important;
    z-index: 99999;
}

.vcode .vcode_main {
	margin: 20px 0px;
}

.vcode .vtitle {
	font-weight: 600;
    padding-left: 10px;
	z-index: 10;
    position: relative;
}

.vcode .pic {
    width: 130px;
    height: auto;
    margin: 0px auto;
}

.vcode .pic #captchaimg {
	width:100%;
	height:40px;
}

.vcode .pic #vcodeloading {
	width: 130px;
    margin: -30px auto;
}

.vcode_input {
    width: 130px;
    margin: 10px auto;
    border-bottom: 1px solid #CECECE;
    padding-bottom: 5px;
    z-index: 9;
    position: relative;
}

.vcode .vcode_post_block {
	margin: 15px auto;
    width: 200px;
}	
.vcode .vcode_post_block .vcode_post {
    width: 100%;
    height: 30px;
    font-size: 14px;
    border: 1px solid #538a14;
    border-radius: 5px;
    background-color: #4CAF50;
    color: #F8F9FB;
    cursor: pointer;
    outline: none;
}

.vcode .vcode_input input {
	font-size: 14px;
	text-align:center;
	border:0px;
	outline:none;
	width:100%;outline:none;
	color: #000;
	background-color: #F9F9F9;
}
');
?>

<div id="vcode" class='mtx vcode' style='display:none;'>
<div class='vtitle'>安全验证</div>
<div class="vcode_main">
<div class='pic'><img id="vcodeloading" /><?= $vcodeImg ?></div>
<div class='vcode_input'>
<input id="vcode_content" name='vcode_content' value='验证码' />
</div>
<div class='vcode_post_block'>
<input id='vcode_post' type='submit' class='vcode_post' value='验证' />
</div>
</div>
</div>

