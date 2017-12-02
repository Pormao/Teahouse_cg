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
$this->title = '资料设置 - 创建茶馆';
?>
<?=CgAvatorUpload::widget(['cgnamemd5' => $get['cgnamemd5'],'defaultImgUrl'=>Yii::$app->params['cgPortraitHeaderUrl'].$get['cgnamemd5']]) ?>
<div class="settings-index">
<div class="mod">

<div class="mtx setting_block" style="padding:0px;margin-left:0px;">

<div class="cgbg"><img id="cgbg" ondragstart="return false;" src="<?= Yii::$app->params['cgPortraitHeaderUrl'].$get['cgnamemd5'] ?>"></div>

<div class="headblock"><img id="userhead" class="userhead" src="<?= Yii::$app->params['cgPortraitHeaderUrl'].$get['cgnamemd5'] ?>"></div>
<?php $form = ActiveForm::begin(); ?>
<div class="cgsettingsform">
<div class="cgname"><?=$cgData['cgname'] ?></div>
<div class="input_border"><span>茶馆描述</span><input name="cg_descr" value="<?=$cgData['cgdescr'] ?>"></div>
<div class="input_border">
<span>茶馆类型</span>
<select id="cg_type" name="cg_type">
	<?php $n=0;foreach (Yii::$app->params['cgType'] as $model): ?>
	<option <?php echo 'value="'.$n.'"'; if($n==$cgData['cgtype']){echo 'selected = "selected"';} $n++; ?>><?= $model ?></option>  
	<?php endforeach ?>
</select>  
</div>
<input name="cgset" type="submit" class="cgbtn" value="保存" />
<input type="submit" class="cgbtn-grey" value="返回" onClick="location.href='<?= Url::to(['/forum/m/u','u' => urlencode(Html::encode($cgData['cgname']))],true) ?>';return false;" />
<div class="clear"></div>
</div>
<?php ActiveForm::end(); ?>
<div class="clear"></div>
</div>

</div>
</div>