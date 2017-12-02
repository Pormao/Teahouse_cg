<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\Web\View;

/* @var $this \yii\web\View */
/* @var $user \common\models\LoginForm */
/* @var $title string */
$this->registerJs('
document.getElementById("userhead").onclick = function(){
	document.getElementById("bg").style.display = "block";
	document.getElementById("avator_form").style.display = "block";
}
document.getElementById("close_btn").onclick = function(){
	document.getElementById("bg").style.display = "none";
	document.getElementById("avator_form").style.display = "none";
}
', View::POS_END);

$this->registerCss('
.avator_form {
	position: fixed;
    width: 440px;
    height: 340px;
    background-color: #fff!important;
    border: 1px solid #D4D4D4;
    left: 50%;
    margin-left: -220px;
    top: 50%;
    margin-top: -170px;
    z-index: 999;
    padding: 20px!important;
    z-index: 99999;
}

.avator_form .title {
    font-size: 15px;
    font-weight: 600;
    color: #444;
    padding-bottom: 15px;
    border-bottom: 1px solid #F1F1F1;
}

.avator_form .avator_head_block {
    margin: 10px auto;
    text-align: center;
    width: 350px;
    height: 290px;
    padding: 25px 0px 0px 0px;
}

.avator_form .avator_head_block .avator_head {
	width: 150px;
    height: 150px;
}

.avator_form .avator_head_block .upload_btn {
    cursor: pointer;
    margin-top: 40px;
    line-height: 27px;
    font-size: 13px;
    color: #3C85BF;
    background-color: rgb(223, 237, 254);
    border: 1px solid #3C85BF;
    position: relative;
    display: inline-block;
    width: 100px;
    height: 30px;
    text-align: center;
}

.avator_form .avator_head_block .close_btn {
	cursor: pointer;
    margin-top: 10px;
    width: 100px;
    height: 30px;
    line-height: 27px;
    font-size: 13px;
    color: #c55;
    display: inline-block;
    background-color: rgb(255, 223, 204);
    border: 1px solid #E46636;
}
.upload_file {
	position:absolute;
	left:0;
	top:0;
	width:100px;
	height:30px;
	z-index:999;
	opacity:0;
	filter: alpha(opacity=0);
    -moz-opacity: 0;
    -khtml-opacity: 0;
	cursor:pointer;
}
');
?>

<div id="avator_form" class="avator_form" style="display:none;">
<div class="title">头像上传</div>
<div class="avator_head_block">
<img src="<?= Html::encode($defaultImgUrl) ?>" ondragstart="return false" class="avator_head" />
<div>


<div class="upload_btn">
上传图片
<?php $form = ActiveForm::begin(['Id' => 'Avatorform','options' => ['enctype' => 'multipart/form-data']]) ?>
<?= $form->field($cgUploadModel, 'file')->fileInput(['id'=>"uploadFileInput",'class'=>"upload_file",'onpropertychange'=>'this.form.submit()','onchange'=>"this.form.submit()",'multiple' => true])->label(false); ?>
<?php ActiveForm::end() ?>	
</div>


<div id="close_btn" class="close_btn">取消</div>
</div>
</div>

</div>