<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\Web\View;
use yii\helpers\Url;
use common\helpers\postApis;

$this->registerCss('
.topic_cg {
	width: 100%;
	height:auto;
}

.topic_list {
    width: 100%;
    height: auto;
    margin-bottom: 10px;
}

.topic_list .topic_block {
    margin: 15px auto;
    width: 94%;
    height: auto;
    min-height: 100px;
    padding: 20px;
    cursor: default;
	
    background: #fff;
    overflow: hidden;
    border-radius: 2px;
    -webkit-box-shadow: 0 1px 3px rgba(0,0,0,.1);
    box-shadow: 0 1px 3px rgba(0,0,0,.1);
	
}

.topic_list .topic_block:hover {
	background-color: #F3FAFF;
}	

.topic_list .topic_block .topic_say {
	width:100%;
	height:auto;
	margin-bottom: 10px;
}

.topic_list .topic_block .topic_bottom {
	position: relative;
	width:100%;
	height:auto;
	min-height: 35px;
}

.topic_list .topic_block .userdata {
    float: right;
}	

.topic_list .topic_block .userdata .userhead {
    margin-top: 2px;
    width: 20px;
    height: 20px;
    float: left;
    border-radius: 3px;
    overflow: hidden;
}	

.topic_list .topic_block .userdata .userhead img {
	width: 100%;
    height: 100%;
}	

.topic_list .topic_block .userdata .username {
    height: 25px;
    line-height: 25px;
    float: left;
    font-size: 12px;
	margin: 0px 6px;
    font-weight: 600;
    color: #5A8FB9;
}

.topic_list .topic_block .cgname {
	float: left;
    font-size: 12px;
    height: 25px;
    line-height: 25px;
    color: #5F5F5F;
}

.topic_list .topic_block .topic_say .topic_say_title {
	position: relative;
    display: inline-block;
    padding-bottom: 3px;
    font-family: STHeiti,"Microsoft Yahei","Microsoft YaHei",Arial,sans-serif;
    font-size: 16px;
    color: #3B413A;
    font-size: 16px;
    font-weight: 600;
    overflow: hidden;
}

.topic_list .topic_block .topic_say .topic_say_title span {
	padding: 1px 13px;
    font-size: 12px;
    color: #698ebf;
    height: 24px;
    line-height: 24px;
    border-radius: 3px;
    border: 1px solid #D5E7FF;
    background: #eff6fa;
}

.topic_list .topic_block .topic_say .topic_say_title span:hover {
	background: #698EBF;
	border: 1px solid #698EBF;
	color:#fff;
}

.topic_list .topic_block .topic_say .topic_say_abstract {
	position: relative;
    font-family: STHeiti,"Microsoft Yahei","Microsoft YaHei",Arial,sans-serif;
    font-size: 14px;
    color: #999;
}

.topic_list .topic_block .topic_say .topic_say_view {
	min-height: 30px;
}

.topic_list .topic_block .topic_say .topic_say_view .topic_say_pic {
    margin: 10px 10px 0px 0px;
    width: 130px;
    height: 90px;
    border: 1px solid #EFEFEF;
	background-color: #fff;
}
	
');
?>
<div class="topic_list">
<?php foreach ($cgThreadsList as $model): ?>

<div class="topic_block">
<div class="topic_say">
<a class="topic_say_title" href="<?= Html::encode(Url::to(['/forum/m/p','t' => Yii::$app->params['postHeaderId']+$model['Id']],true)) ?>">
<span><?= Html::encode($model['post_floor_num']) ?></span>
<?= Html::encode($model['post_title']) ?>
</a>
<div class="topic_say_abstract"><?= Html::encode($model['post_abstract']) ?></div>

<div class="topic_say_view">

<?php
for ($x=0; $x<=2; $x++) {
	$pic = @postApis::getpic($model['post_content'])[$x];
	if($pic){echo '<img class="topic_say_pic" src="'.$pic.'" />';}
}
?>

</div>

</div>

<div class="topic_bottom">

<div class="userdata">
<div class="userhead"><img src='<?= Yii::$app->params['userPortraitHeaderUrl'].$model['uid'] ?>' /></div>
<div class="username">@<?=$model['username'] ?></div>
<div class="cgname"><?=$model['cgname'] ?>馆</div>
</div>

</div>

<div class="clear"></div>

</div>
<div class="clear"></div>
<?php endforeach ?>
</div>






