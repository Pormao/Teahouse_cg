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
use app\widgets\CgPortraitUpload\CgAvatorUpload;

AppAsset::register($this);
$baseUrl = $this->assetBundles[AppAsset::className()]->baseUrl."/"; 

/* @var $this yii\web\View */
$this->title = '头像设置 - 创建茶馆';
?>
<?=CgAvatorUpload::widget(['cgnamemd5' => $get['cgnamemd5'],'defaultImgUrl'=>Yii::$app->params['cgPortraitHeaderUrl'].$get['cgnamemd5']]) ?>
<div class="createcg-index">
<div class="mod">

<?php $form = ActiveForm::begin(); ?>
<div class="mtx createcgform">

<div class="stepBar">
<div class="step"><div class="label">1</div></div>
<div class="step"><div class="label on">2</div></div>
<div class="step"><div class="label">3</div></div>
</div>

<div class="stepTitle">头像设置</div>
<div class="headblock"><img id="userhead" class="userhead" src="<?= Yii::$app->params['cgPortraitHeaderUrl'].$get['cgnamemd5'] ?>"></div>

<input name="cgcreate2" type="submit" class="cgbtn" value="完成" />
<div class="clear"></div>

</div>
<?php ActiveForm::end(); ?>
</div>
</div>