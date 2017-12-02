<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\helpers\HtmlPurifier;
use app\widgets\PageBar\PageBar;
use app\widgets\Vcode\Vcode;
use yii\helpers\Url;

use yii\captcha\Captcha;

AppAsset::register($this);
$baseUrl = $this->assetBundles[AppAsset::className()]->baseUrl."/"; 
$this->registerJsFile($baseUrl.'js/cg-thread.js',['depends'=>['frontend\assets\AppAsset']]);

/* @var $this yii\web\View */
$this->title = $cgThreadData['post_title'].' '.$cgThreadData['cgname'].'馆 - 珀猫茶馆';
?>
<input id="p" value="<?=$get['t'] ?>" type="hidden" />

	<link type="text/css" rel="stylesheet" href="/libs/syntaxhighlighter/styles/shCoreDefault.css"/>
	
<div class="m-cgthread">
<?php Vcode::begin(['vcodePath'=>'../api/forum/thread']); ?>
<?= Captcha::widget(['name'=>'captchaimg','captchaAction'=>'/api/forum/thread/captcha','imageOptions'=>['id'=>'captchaimg', 'title'=>'换一个', 'alt'=>'换一个', 'style'=>'cursor:pointer'],'template'=>'{image}']); ?>
<?php Vcode::end(); ?>

<div class="mod" style="padding:0px;background-color:transparent;">

<div class="mtx page_block" style="padding:0px;">
<?= PageBar::widget(['page'=>@$get['pg'],'pageNum'=>9,'dataCount'=>$cgThreadsReplyCount]) ?> 
</div>

<div class="cgdataHeader" style="padding:0px;">
<div class="cg_thread_title">
<span class="title">
<?php 
if($cgThreadData['uid'] == @Yii::$app->user->identity->Id){
	echo '<a id="del_thread_btn">[删除]</a>';
}
echo Html::encode(@$cgThreadData['post_title']);
 ?>
</span> 
</div>
<div class="clear"></div>


<div id="master_thread_block" class="master_thread_block">

<div class="label">
<div class="thread_username"><?=Html::encode($cgThreadData['username']) ?></div>
<a href="<?= Url::to(['/forum/m/u','u' => Html::encode(@$cgThreadData['cgname'])],true) ?>"><div class="thread_cgname"> <?= Html::encode(@$cgThreadData['cgname']) ?>馆 </div></a>
</div>

<div class="thread_say">
<div class="thread_say_content"><?= HtmlPurifier::process(@$cgThreadData['post_content']) ?></div>
<div class="thread_funbar">
<span class="thread_say_time"><?= Html::encode(date("Y-m-d H:i:s ",@$cgThreadData['post_time'])) ?></span>
<span class="thread_say_floor_num">#<?= Html::encode($i=1) ?></span>
</div>
<div class="clear"></div>
</div>

</div>
<div class="master_thread_morebar"><div id="load_master_more">加载更多</div></div>


<div class="clear"></div>
</div>

<div class="thread_build">

<?php foreach ($cgThreadsBuild as $model): ?>
<?php $rid=Html::encode(Yii::$app->params['postReplyHeaderId']+$model['Id']) ?>
<div class="mtx thread_block">
<div class="_r" id="r<?= $rid ?>"></div>
<?php if(Yii::$app->user->Id == $model['uid']){echo '<div class="thread_say_del clear"><div class="say_del_ic" id="thread_say_del_'.$rid.'" ></div><div class="say_del_bg"></div></div>';}?>
<div class="thread_userdata">
<div class="userheadborder"><img class="userhead" src="<?= Yii::$app->params['userPortraitHeaderUrl'].$model['uid'] ?>" /></div>
<div class="thread_username"><?= Html::encode($model['username']) ?></div>
</div>
<div class="clear">
</div>

<div class="thread_say">
<div class="thread_say_content"><?= HtmlPurifier::process($model['post_content']) ?></div>

<!--lzl-->
<div class="reply_block">
<div class="reply_build_btn"><a id="reply_build_btn_<?= $rid ?>" >回复(<?= Html::encode($model['post_floor_num']) ?>)</a></div>

<div class="reply_build_block">
<ul class="reply_build" id="reply_build_<?= $rid ?>" page="1" data-field="<?php $buildData = json_encode(array('senduid'=> $model['uid'],'sendun'=>$model['username']));echo Html::encode($buildData);?>"></ul>
<div class="reply_loadmore" title="解锁更多姿势~~~">更多<span>1</span></div>

<div class="reply_build_bottom clear">
<div class="reply_build_floor_input_btn">我有话说</div>
</div>

</div>

</div>
<!--lzl-->

</div>
</div>
<?php endforeach ?>

</div>

<div class="thread_reply_input mtx">
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
				});
			});
			
			function getEditHtml (){
					return editor.html()
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
			<textarea id="content_input" name="content" style="width:100%;margin:10px auto; height:200px;visibility:hidden;">Hi 快把你想说的告诉大家吧~</textarea>
			<div class="cgreply_input_block clear">
			
			
			<?php
			if (Yii::$app->user->isGuest) {
				echo '<a class="cgbtn-grey" href="site/login">游客登录</a>';
			} else {
				echo '<input name="cgreply" type="submit" class="cgbtn" value="回复" onclick="return readySend();" />';
			}
			?>
			</div>
		<?php ActiveForm::end(); ?>

</div>

	<script type="text/javascript" src="/libs/syntaxhighlighter/scripts/shCore.js"></script>
	<script type="text/javascript" src="/libs/syntaxhighlighter/scripts/shAutoloader.js"></script>
	<script type="text/javascript" src="/libs/syntaxhighlighter/scripts/shBrushJScript.js"></script>
	<script language="javascript">
	function path(){
		var args = arguments,
			result = [];
		for(var i = 0; i < args.length; i++)
			result.push(args[i].replace('@', '/libs/syntaxhighlighter/scripts/'));//请替换成自己项目中SyntaxHighlighter的具体路径
		return result
	};
	SyntaxHighlighter.autoloader.apply(null, path(
	'applescript        @shBrushAppleScript.js',
	'actionscript3 as3      @shBrushAS3.js',
	'bash shell     @shBrushBash.js',
	'coldfusion cf      @shBrushColdFusion.js',
	'cpp c          @shBrushCpp.js',
	'c# c-sharp csharp      @shBrushCSharp.js',
	'css            @shBrushCss.js',
	'delphi pascal      @shBrushDelphi.js',
	'diff patch pas     @shBrushDiff.js',
	'erl erlang     @shBrushErlang.js',
	'groovy         @shBrushGroovy.js',
	'java           @shBrushJava.js',
	'jfx javafx     @shBrushJavaFX.js',
	'js jscript javascript  @shBrushJScript.js',
	'perl pl            @shBrushPerl.js',
	'php            @shBrushPhp.js',
	'text plain     @shBrushPlain.js',
	'py python          @shBrushPython.js',
	'ruby rails ror rb      @shBrushRuby.js',
	'sass scss          @shBrushSass.js',
	'scala          @shBrushScala.js',
	'sql            @shBrushSql.js',
	'vb vbnet           @shBrushVb.js',
	'xml xhtml xslt html        @shBrushXml.js'
	));
	SyntaxHighlighter.all();
	</script>