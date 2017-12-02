<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use app\widgets\UserAvatorUpload\UserAvatorUpload;
use app\widgets\ExperienceBar\ExperienceBar;

use yii\captcha\Captcha;

AppAsset::register($this);
$baseUrl = $this->assetBundles[AppAsset::className()]->baseUrl."/"; 

/* @var $this yii\web\View */
$this->title = '个人资料 - 珀猫茶馆';
?>
<?php if(@Yii::$app->user->Id == $userData['id']){
	echo UserAvatorUpload::widget(['defaultImgUrl'=>Yii::$app->params['userPortraitHeaderUrl'].Yii::$app->user->identity->Id]);
}
?>
<div class="site-profile">
<div class="profileMod">

<div class="mtx mod" style="padding:0px;">

<div class="userdataHeader">
<div class="perdata clear">
<div class="headblock"><img id="userhead" class="userhead" src="<?= Yii::$app->params['userPortraitHeaderUrl'].$userData['id'] ?>"></div>

<div class="userblock">
<div class="username">
<?= Html::encode($userData['username']) ?>
</div>

</div>

</div>
</div>

</div>

</div>
</div>