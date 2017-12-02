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
.hot_topic_view {
    width: 385px;
	float: right;
}

.hot_topic_view .hot_topic_view_block {
    float: left;
    cursor: pointer;
    width: 120px;
    height: 92px;
    margin: 4px;
    border-radius: 4px;
    overflow: hidden;
}

.hot_topic_view .hot_topic_view_block .hot_topic_view_block_bg {
	width:100%;
    height: 22px;
    background-color: #000;
	filter: alpha(opacity=30);
    -moz-opacity: 0.3;
    -khtml-opacity: 0.3;
    opacity: 0.3;
    position: relative;
    top: -25%;
    z-index: 999;
	color: #FFF;
    font-size: 14px;
    overflow: hidden;
}

.hot_topic_view .hot_topic_view_block .hot_topic_view_block_title {
	width:90%;
	margin:0px auto;
    height: 22px;
    position: relative;
    top: -48%;
    z-index: 999;
	color: #FFF;
    font-size: 13px;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
}

.hot_topic_view .hot_topic_view_block:hover .hot_topic_view_block_bg {
	width:100%;
    height: 92px;
    background-color: #000;
	filter: alpha(opacity=80);
    -moz-opacity: 0.8;
    -khtml-opacity: 0.8;
    opacity: 0.8;
    position: relative;
    top: -100%;
    z-index: 999;
    overflow: hidden;
}

.hot_topic_view .hot_topic_view_block:hover .hot_topic_view_block_title {
	width:90%;
	margin:10px auto;
    height: 90px;
    position: relative;
    top: -200%;
    z-index: 999;
	color: #FFF;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: normal;
}

.hot_topic_view .hot_topic_view_block .hot_topic_view_img_border {
	width: 100%;
    height: 100%;
}

.hot_topic_view .hot_topic_view_block .hot_topic_view_img_border img {
	width:100%;
	height:100%;
}
');
?>
<div class="hot_topic_view">
<?php foreach ($hotTopicView as $model): ?>
<a href="<?= Html::encode(Url::to(['/forum/m/p','t' => Yii::$app->params['postHeaderId']+$model['Id']],true)) ?>">
<div class="hot_topic_view_block">
<div class="hot_topic_view_img_border">
<?php
for ($x=0; $x<=2; $x++) {
	$pic = @postApis::getpic($model['post_content'])[$x];
	if($pic){echo '<img class="hot_topic_view_img" src="'.$pic.'" />';}
}
?>
</div>
<div class="hot_topic_view_block_bg"></div>
<div class="hot_topic_view_block_title"><?=Html::encode($model['post_title']) ?></div>
</div>
</a>
<?php endforeach ?>
</div>