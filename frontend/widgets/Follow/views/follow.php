<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\Web\View;

$this->registerJs('
document.getElementById("follow_btn").onclick = function(){
	var csrfToken = $('."'".'meta[name="csrf-token"]'."'".').attr("content");
	 var cgid = document.getElementById("cgid").value;
	if(document.getElementById("follow_btn").innerHTML == "关注"){var follow = 1;}else{var follow = 0;}
	$.ajax({
	type: "POST",
	url:"../api/forum/follow/fc",
	data:{
		"_csrf-frontend":csrfToken,
		cgid:cgid,
		follow:follow
		},
	success: function(data){
			  if(data.code == "success"){
				  if(data.cause == 1){
					  document.getElementById("follow_btn").innerHTML = "已关注";
					  document.getElementById("follow_btn").className = "cgfollowbtn followed";
				  }else{
					  document.getElementById("follow_btn").innerHTML = "关注";
					  document.getElementById("follow_btn").className = "cgfollowbtn";
				  }
			  }
			},
	dataType: "json"//返回数据的类型
	});  
	
}
', View::POS_END);

$this->registerCss('
.cgfollowbtn {
    cursor: pointer;
    font-size: 10px;
    border: 1px solid #3674FF;
    padding: 1px 5px;
    color: #f0f9ff;
    background-color: #218DFD;
    border-radius: 2px;
    margin: 6px 12px;
    float: left;
}

.followed {
	border: 1px solid #D65538;
    background-color: rgb(236, 111, 111);
}
');
?>
<?php
if($follow == 1){
	echo '<div id="follow_btn" class="cgfollowbtn followed">已关注</div>';
}else{
	echo '<div id="follow_btn" class="cgfollowbtn">关注</div>';
}
?>






