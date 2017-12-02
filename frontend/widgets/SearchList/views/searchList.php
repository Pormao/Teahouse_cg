<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\Web\View;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $user \common\models\LoginForm */
/* @var $title string */

$this->registerCss('
.search_cg {
	width: 810px;
	height:auto;
}

.search_list {
	width:810px;
	height:auto;
	margin-bottom:10px;
}

.search_list .search_block {
    height: auto;
    min-height: 100px;
    border-left: 2px solid #E4E4E4;
    padding: 15px 15px 0px 25px;
    cursor: default;
    border: 1px solid #dcdcdc;
    border-bottom: 2px solid #7AB5FF;
    background-color: #fff;
    margin-bottom: 20px;
    box-shadow: -1px 2px 10px #d8d8d8;
}

.search_list .search_block:hover {
	background-color: #F3FAFF;
}	

.search_list .search_block .search_say {
	width:100%;
	height:auto;
	margin-bottom: 10px;
}

.search_list .search_block .search_bottom {
	position: relative;
	width:100%;
	height:auto;
	min-height: 35px;
}

.search_list .search_block .search_say .search_say_title {
	position: relative;
    display: inline-block;
    padding-bottom: 3px;
    font-family: STHeiti,"Microsoft Yahei","Microsoft YaHei",Arial,sans-serif;
    font-size: 16px;
    font-weight: 600;
    color: #444;
    overflow: hidden;
}

.search_list .search_block .search_say .search_say_abstract {
    position: relative;
    font-family: STHeiti,"Microsoft Yahei","Microsoft YaHei",Arial,sans-serif;
    font-size: 12px;
    color: #7B7B7B;
}

.search_list .search_block .search_say .search_say_view {
	min-height: 30px;
}

.search_list .search_block .search_say .search_say_view .search_say_pic {
    margin: 10px 10px 0px 0px;
    width: 130px;
    height: 90px;
    border: 1px solid #EFEFEF;
	background-color: #fff;
}
');
?>
<div class="search_list">
<?php foreach ($searchList as $model): ?>
<div class="search_block">
<div class="search_say">
<div class="search_circle"></div>
<a class="search_say_title" href="<?= Html::encode(Url::to(['/forum/m/p','t' => Yii::$app->params['postHeaderId']+$model['Id']],true)) ?>">
<?= Html::encode($model['post_title']) ?>
</a>
<div class="search_say_abstract"><?= Html::encode($model['post_abstract']) ?></div>

</div>

<div class="search_bottom">

</div>

<div class="clear"></div>

</div>
<?php endforeach ?>
</div>