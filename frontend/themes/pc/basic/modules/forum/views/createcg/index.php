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

/* @var $this yii\web\View */
$this->title = '基本信息 - 创建茶馆';
?>
<div class="createcg-index">
<div class="mod">

<?php $form = ActiveForm::begin(); ?>
<div class="mtx createcgform">

<div class="stepBar">
<div class="step"><div class="label on">1</div></div>
<div class="step"><div class="label">2</div></div>
<div class="step"><div class="label">3</div></div>
</div>

<div class="stepTitle">基本信息</div>
<div class="input_border"><span>茶馆名称</span><input name="cg_name" value="" /></div>
<div class="input_border"><span>茶馆描述</span><input name="cg_descr" value="" /></div>

<div class="input_border">
<span>茶馆类型</span>
<select id="cg_type" name="cg_type">
	<?php $n=0;foreach (Yii::$app->params['cgType'] as $model): ?>
	<option value="<?php echo $n; $n++; ?>"><?= $model ?></option>  
	<?php endforeach ?>
</select>  
</div>

<input name="cgcreate" type="submit" class="cgbtn" value="创建" />
<div class="clear"></div>

</div>
<?php ActiveForm::end(); ?>
</div>
</div>