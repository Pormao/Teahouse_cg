<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\widgets\PageBar\PageBar;
use app\widgets\Follow\Follow;
use app\widgets\ExperienceBar\ExperienceBar;
use app\widgets\Follow\FollowList;
use app\widgets\TopicList\TopicList;
use app\widgets\RankList\RankList;
use app\widgets\Vcode\Vcode;
use yii\captcha\Captcha;

AppAsset::register($this);
$baseUrl = $this->assetBundles[AppAsset::className()]->baseUrl."/"; 
$this->registerJsFile($baseUrl.'js/cg-main.js',['depends'=>['frontend\assets\AppAsset']]);

/* @var $this yii\web\View */
$this->title = '珀猫茶馆';
?>
<input id="cgid" value="<?= $cgdata['Id'] ?>" type="hidden" />
<div class="m-cgmain">
<?php Vcode::begin(['vcodePath'=>'../api/forum/thread']); ?>
<?= Captcha::widget(['name'=>'captchaimg','captchaAction'=>'/api/forum/thread/captcha','imageOptions'=>['id'=>'captchaimg', 'title'=>'换一个', 'alt'=>'换一个', 'style'=>'cursor:pointer'],'template'=>'{image}']); ?>
<?php Vcode::end(); ?>

<div class="mod">

<div class="mod-left">

<div class="cgmain">
<div class="cgdataHeader">

<a href="<?=Url::to(['/forum/settings','cgnamemd5'=>$cgnamemd5],true) ?>"><div class="cg_settings"><div class="set_ic"></div><div class="set_bg"></div></div></a>

<div style="width:100%;margin-bottom:25px;float:left;">
<img class="cghead" src="<?=Yii::$app->params['cgPortraitHeaderUrl'].$cgnamemd5 ?>" />
<div class="cgdata">
<div class="cgdataa">
<div class="cgname"> <?= Html::encode($cgdata['cgname']) ?>馆 </div>
<?php if (!Yii::$app->user->isGuest) {echo Follow::widget(['cgid' => $cgdata['Id']]);}?>
<div class="clear"></div>
<div class="cgdatab">
<div class="cgfollownum">关注:<span><?= Html::encode($cgdata['cg_follow_num']) ?></span></div>
<div class="cgthreadnum">帖子:<span><?= Html::encode($cgdata['cg_thread_num']) ?></span></div>
</div>
<div class="clear"></div>
<a class="cgdescr"> <?= Html::encode(@$cgdata['cgdescr']) ?> </a>
</div>
</div>
</div>

<div class="clear"></div>
</div>
<div class="clear"></div>
<div class="topic_cg">
<!-- topic -->
<?= TopicList::widget(['cgThreadsList'=>$cgThreadsList]) ?> 

<?= PageBar::widget(['page'=>@$get['pg'],'pageNum'=>10,'dataCount'=>$cgThreadsCount]) ?> 
</div> 

<p class="class_title"><span style="border-bottom: 3px solid #74C55F;">发表帖子</span></p>
<div class="mtx editblock">
	<link href="/libs/kindeditor-master/themes/default/default.css" rel="stylesheet">
	<script src="/libs/kindeditor-master/kindeditor-all.js"></script>
	<script src="/libs/kindeditor-master/lang/zh-CN.js"></script>
		<script>
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="content"]', {
					resizeType : 1,
					allowPreviewEmoticons : false,
					allowImageUpload : true,
					items : [
						'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
						'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
						'insertunorderedlist', '|', 'emoticons', 'image', 'link', 'code']
				}
				);
				
			});
			
			function getEditHtml (){
					return editor.html();
			}
			
			
		</script>
		<script type="text/javascript"><!--
		google_ad_client = "ca-pub-7116729301372758";
		/* 更多演示（728x90） */
		google_ad_slot = "5052271949";
		google_ad_width = 728;
		google_ad_height = 90;
		//-->
		</script>
		
		<?php $form = ActiveForm::begin(); ?>
			<div class="topic_title_input">
			<div><input name="title" value="标题党?咋不去某C当编辑呢!" /></div>
			</div>
			<textarea id="content_input" name="content" style="width:100%; margin: 10px auto;">Hi 快把你想说的告诉大家吧~</textarea>
			<?php
			if (Yii::$app->user->isGuest) {
				echo '<a class="cgbtn-grey" href="'.Url::to(['/site/login'],true).'">游客登录</a>';
			} else {
				echo '<input name="cgpublish" type="submit" class="cgbtn" value="立即发表" onclick="return readySend();" />';
			}
			?>
		<?php ActiveForm::end(); ?>
	<div class="clear"></div>	
</div>
</div>

</div>
<div class="mod-right" style="width:200px;">

<div class="mtx perdata" >
<div>
<div class="headblock"><img class="userhead" src="<?= Yii::$app->params['userPortraitHeaderUrl'].@Yii::$app->user->identity->Id ?>" /></div>
<div class="username">
<?php

if(Yii::$app->user->isGuest){
	echo '<a href="'.Url::to(['/site/login'],true).'">游客登录</a>';
}else{
	echo '<a href="'.Url::to(['/user/profile','u' =>@Yii::$app->user->identity->Id]).'">'.Yii::$app->user->identity->username.'</a>';
}
 
?>
</div>
</div>

<div class="clear"></div>

<?php
if (!Yii::$app->user->isGuest) {
	echo ExperienceBar::widget(['exp' => 1000]);
	echo FollowList::widget(['uid' => @Yii::$app->user->identity->Id]);
}
?>

</div>

<div class="mtx rankinglist">
<p class="class_title"><span style="border-bottom: 3px solid #FF738D;">热议榜</span></p>
<?= RankList::widget() ?>
</div>

</div>
<div class="clear"></div>

</div>

