<?php
use yii\helpers\Url;
use app\widgets\Follow\FollowList;
use app\widgets\RankList\RankList;
use app\widgets\HotCgList\HotCgList;
use app\widgets\SlideView\SlideView;
use app\widgets\HotTopic\HotTopicList;
use app\widgets\HotTopic\HotTopicView;

/* @var $this yii\web\View */

$this->title = '珀猫茶馆';
?>
<div class="site-index">

<div class="mod">
<div class="mod-left">
<div class="mtx" style="width:810px;">
<?=SlideView::widget() ?>
<?= HotTopicView::widget(['viewNum' => '6']) ?>
<div class="clear"></div>
</div>

<div class="mtx hot_topic_cg">
<p class="class_title"><span>话题动态</span></p>
<?= HotTopicList::widget() ?>
</div>

</div>

<div class="mod-right" style="width:200px;">

<div class="mtx perdata">

<div class="basicdata">
<div class="headblock">
<a href="<?= Url::to(['user/profile','u' =>@Yii::$app->user->identity->Id]) ?>">
<img class="userhead" src="<?= Yii::$app->params['userPortraitHeaderUrl'].@Yii::$app->user->identity->Id ?>" />
</a>
</div>
<div class="username">
<?php

if(Yii::$app->user->isGuest){
	echo '<a href="'.Url::to(['site/login']).'">游客登录</a>';
}else{
	echo '<a href="'.Url::to(['user/profile','u' =>@Yii::$app->user->identity->Id]).'">'.Yii::$app->user->identity->username.'</a>';
}
 
?>

</div>
</div>

<div class="clear"></div>


<?php
if (!Yii::$app->user->isGuest) {
echo FollowList::widget(['uid' => @Yii::$app->user->identity->Id]);
}
?>


</div>

<div class="mtx hot_cg">
<p class="class_title"><span style="border-bottom: 3px solid #FFAC30;">热门茶馆</span></p>

<?=HotCgList::widget() ?>

</div>

<div class="mtx rankinglist">
<p class="class_title"><span style="border-bottom: 3px solid #FF738D;">热议榜</span></p>

<?= RankList::widget() ?>

</div>

</div>
<div class="clear"></div>

</div>
