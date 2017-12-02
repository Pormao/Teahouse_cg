<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

AppAsset::register($this);
$baseUrl = $this->assetBundles[AppAsset::className()]->baseUrl."/"; 


$this->registerJsFile($baseUrl.'js/cg-message.js',['depends'=>['frontend\assets\AppAsset']]);
/* @var $this yii\web\View */
$this->title = '消息中心';
?>
<div class="message-index">
<div class="mod">

<div class="messagebody mtx">
<div class="title">消息中心</div>
<div class="message_block clear">
<div class="messageType_block">
<ul>
<li class="t hover">系统消息</li>
<li class="t">贴子消息</li>
</ul>
</div>

<div class="messageMain_block">

<ul id="msgM" class="cg">

</ul>
<div id="cg_loadmore" class="loadmore">加载更多<span>1</span></div>
</div>
</div>

</div>

</div>
