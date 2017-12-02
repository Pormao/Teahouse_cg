<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\Web\View;
use yii\helpers\Url;
use common\helpers\levelApis;//等级相关函数
use frontend\assets\AppAsset;

AppAsset::register($this);
$baseUrl = $this->assetBundles[AppAsset::className()]->baseUrl; 

$this->registerCss("
.lovecglist {
	width:100%;
	height:auto;
}

.lovecglist > div {
	width: 270px;
	margin:10px auto;
}

.lovecglist .lcg {
    background: url(/assets/71fefb46/images/love_cg.png) no-repeat 4px 2px;
    border-bottom: 2px solid #AFD1FF;
    background-color: #E1F1F9;
    color: #6589B9;
    width: 90px;
    height: 25px;
    line-height: 30px;
    cursor: pointer;
    text-align: left;
    border-radius: 3px;
    font-size: 13px;
    overflow: hidden;
    display: inline-block;
    _zoom: 1;
    _display: inline;
    margin: 4px;
}

.lovecglist .lcg > div {
    margin: 0px 0px 0px 1px;
    color: #fff;
    font-size: 10px;
    text-align: center;
    width: 30px;
    overflow: hidden;
    float: left;
}

.lovecglist .lcg:hover {
    background-color: rgb(218, 235, 253);
}
");
?>
<div class="lovecglist">
<div>
<?php foreach ($followList as $model): ?>
<a href="<?= Url::to(['/forum/m/u','u' => $model['cgname']],true) ?>"><div class="lcg"><div><?=levelApis::calLevel($model['exp']) ?></div><?=$model['cgname'] ?>馆</div></a>
<?php endforeach ?>
</div>
</div>






