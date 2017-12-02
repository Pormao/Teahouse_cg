<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\widgets\SearchList\SearchList;

$this->title = '珀猫搜索';
?>
<div class="site-search">
<div class="mod">

<div class="search_block">
<div class="searchInput">
<input id="searchContent" type="text" value="<?php if(@$get['wd']){echo $get['wd'];}else{echo '搜索 用户/茶馆/话题';} ?>" />
</div>
<div id="searchBtn" class="searchBtn">探索</div>
<div class="clear"></div>
</div>

<div class="search_build">
<?=SearchList::widget(['searchList' => $searchList]) ?>
</div>
</div>
</div>
<script>
document.getElementById("searchBtn").onclick = function(){
	window.location.href="/search?wd="+document.getElementById("searchContent").value; 
}
</script>