<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\Web\View;
use yii\helpers\Url;
use common\helpers\postApis;

/* @var $this \yii\web\View */
/* @var $user \common\models\LoginForm */
/* @var $title string */

$this->registerCss('
.hot_topic_cg {
	width: 810px;
	height:auto;
}

.hot_topic_list {
	width:810px;
	height:auto;
	margin-bottom:10px;
}

.hot_topic_list .hot_topic_block {
    height: auto;
    min-height: 100px;
    border-left: 2px solid #E4E4E4;
    padding: 15px 15px 0px 35px;
    cursor: default;
}

.hot_topic_list .hot_topic_block:hover {
	background-color: #F3FAFF;
}	

.hot_topic_list .hot_topic_block .hot_topic_say {
	width:100%;
	height:auto;
	margin-bottom: 10px;
}

.hot_topic_list .hot_topic_block .hot_topic_bottom {
	position: relative;
	width:100%;
	height:auto;
	min-height: 35px;
}

.hot_topic_list .hot_topic_block .hot_topic_circle {
    background: #d9efff;
    border-radius: 100%;
    border: 2px solid #52b3ff;
    width: 10px;
    height: 10px;
    float: left;
    margin-left: -43px;
    margin-top: 5px;
}

.hot_topic_list .hot_topic_block .userdata {
    float: right;
}	

.hot_topic_list .hot_topic_block .userdata .userhead {
    margin-top: 2px;
    width: 20px;
    height: 20px;
    float: left;
    border-radius: 3px;
    overflow: hidden;
}	

.hot_topic_list .hot_topic_block .userdata .userhead img {
	width: 100%;
    height: 100%;
}	

.hot_topic_list .hot_topic_block .userdata .username {
    height: 25px;
    line-height: 25px;
    float: left;
    font-size: 12px;
	margin: 0px 6px;
    font-weight: 600;
    color: #5A8FB9;
}

.hot_topic_list .hot_topic_block .cgname {
	float: left;
    font-size: 12px;
    height: 25px;
    line-height: 25px;
    color: #5F5F5F;
}

.hot_topic_list .hot_topic_block .hot_topic_say .hot_topic_say_title {
	position: relative;
    display: inline-block;
    padding-bottom: 3px;
    font-family: STHeiti,"Microsoft Yahei","Microsoft YaHei",Arial,sans-serif;
    font-size: 16px;
    font-weight: 600;
    color: #444;
    overflow: hidden;
}

.hot_topic_list .hot_topic_block .hot_topic_say .hot_topic_say_abstract {
    position: relative;
    font-family: STHeiti,"Microsoft Yahei","Microsoft YaHei",Arial,sans-serif;
    font-size: 12px;
    color: #7B7B7B;
}

.hot_topic_list .hot_topic_block .hot_topic_say .hot_topic_say_view {
	min-height: 30px;
}

.hot_topic_list .hot_topic_block .hot_topic_say .hot_topic_say_view .hot_topic_say_pic {
    margin: 10px 10px 0px 0px;
    width: 130px;
    height: 90px;
    border: 1px solid #EFEFEF;
	background-color: #fff;
}
');
?>
<div class="hot_topic_list">
<?php foreach ($hotTopicList as $model): ?>
<div class="hot_topic_block">
<div class="hot_topic_say">
<div class="hot_topic_circle"></div>
<a class="hot_topic_say_title" href="<?= Html::encode(Url::to(['/forum/m/p','t' => Yii::$app->params['postHeaderId']+$model['Id']],true)) ?>">
<?= Html::encode($model['post_title']) ?>
</a>
<div class="hot_topic_say_abstract"><?= Html::encode($model['post_abstract']) ?></div>

<div class="hot_topic_say_view">

<?php
for ($x=0; $x<=2; $x++) {
	$pic = @postApis::getpic($model['post_content'])[$x];
	if($pic){echo '<img class="hot_topic_say_pic" src="'.$pic.'" />';}
}
?>

</div>

</div>

<div class="hot_topic_bottom">

<div class="userdata">
<div class="userhead"><img src='<?= Yii::$app->params['userPortraitHeaderUrl'].$model['uid'] ?>' /></div>
<div class="username"><?=$model['username'] ?></div>
<div class="cgname"><?=$model['cgname'] ?></div>
</div>

</div>

<div class="clear"></div>

</div>
<?php endforeach ?>
</div>