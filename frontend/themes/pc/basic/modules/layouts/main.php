<?php

/* @var $this \yii\web\View */
/* @var $content string */



use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

use app\models\MessageForm;

AppAsset::register($this);

$baseUrl = $this->assetBundles[AppAsset::className()]->baseUrl."/"; 
//$this->registerJsFile($baseUrl.'js/123.js');

$messageModel = new MessageForm;
$messageCount = @$messageModel->getCgMessageCount(Yii::$app->user->identity->Id);
if($messageCount > 0){$messageCountLabel = '('.$messageCount.')';}else{$messageCountLabel = '';}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
    <meta charset="<?= Yii::$app->charset ?>">
<!--    <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
	<meta name="viewport"content="width=1300, initial-scale=0.5"/> 
<?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
<div class="wrap">
<div id="bg" class="bg" style='display:none;'></div>
<div id="nav"></div>
<div id="nav-bar">
<a href="/"><div class="nav-logow"></div></a>

<div class="nav-right">
<span class="nav-user">
<?php
if (Yii::$app->user->isGuest) {
		echo Html::a(Yii::t('common','Login'), ['/site/login'],['class'=>'nav-signup']).Html::a(Yii::t('common','Signup'), ['/site/signup'],['class'=>'nav-signin']);
		} else {
		echo Html::a(Yii::$app->user->identity->username,Url::to(['/user/profile','u' =>Yii::$app->user->identity->Id]),['class'=>'nav-signin']).Html::a("消息".$messageCountLabel,Url::to(['/message/m/index']),['class'=>'nav-signin']).Html::a('退出',['/site/logout'],['class'=>'nav-signin']);
	}
?>
</span>
<span class="nav-search">
<input id="search_content" value="搜索 用户/茶馆/话题"/>
<div id="search_btn" class="btn"></div>
</span>
</div>

</div>

<div id="nav-bar-list" style="display:none;" >
<ul id="menu">
<li class="active"><?= Html::a(Yii::t('common','Home'), ['/site/index'])?></li>
<li><?= Html::a(Yii::t('common','About'), ['/site/about'])?></li>
<li><?= Html::a(Yii::t('common','Contact'), ['/site/contact'])?></li>
<li><?= Html::a(Yii::t('common','Signup'), ['/site/signup'])?></li>
<li><?= Html::a(Yii::t('common','Login'), ['/site/login'])?></li>
</ul>
</div>
	
    <div class="container">
	<input id="uid" value="<?=@Yii::$app->user->identity->Id?>" type="hidden" />
	
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
	
</div>
<footer>
<div class="footer">
	<div class="footer-left">
		<ul class="footer-link">
		<li><a href="http://weibo.com/u/3236379364">· 开发者微博</a></li>
		<li><a href="https://shop142470772.taobao.com/shop/view_shop.htm?spm=a313o.201708ban.category.d53.e44c946baOSbQ&mytmenu=mdianpu&user_number_id=2633537866">· 官方店铺</a></li>
		</ul>
		
	</div>	
	<div class="footer-right">
		<span>我想分享我的快乐~</span>
		<div class="weibo_code"></div>
	</div>	
<div class="clear"></div>
<a class="pull-copy">&copy; Pormao <?= date('Y') ?></a>
<a class="pull-run">running for <span id="seconds">0</span> seconds</a>

<script>
function timest() {var tmp = Date.parse( new Date() ).toString();tmp = tmp.substr(0,10);return tmp;}
var start = 1495201024;
setInterval(function(){
	  var now = timest();
	  document.getElementById("seconds").innerHTML = now - start;
},1000)
document.getElementById("search_btn").onclick = function(){
	window.location.href="/search?wd="+document.getElementById("search_content").value; 
}
</script>
</div>	
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>