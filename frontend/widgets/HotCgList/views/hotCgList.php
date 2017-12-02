<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\Web\View;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $user \common\models\LoginForm */
/* @var $title string */

$this->registerCss('
.hot_cg {
	width: 100%;
    height: auto;
    position: relative;
}

.hot_cg .card {
    margin: 0px auto;
    width: 100%;
	cursor:pointer;
}

.hot_cg .card .cg_card {
    width: 100%;
    height: 70px;
    display: inline-block;
    background-color: #FFF;
    box-shadow: 0px 10px 10px -13px #424242;
    _zoom: 1;
    _display: inline;
    margin-bottom: 8px;
}

.hot_cg .card .cg_card:hover {
	background-color:#FFFFE0;
}

.hot_cg .hot_cg_tip {
    position: absolute;
    width: 0;
    height: 0;
    border-top: 10px solid #E53333;
    border-right: 10px solid transparent;
    top: 0;
    left: 0;
}

.hot_cg .card .cg_card .cg_head {
	width: 59px;
    height: 59px;
    margin-left: 5px;
    margin-top: 5px;
    float: left;
    border-radius: 3px;
}

.hot_cg .card .cg_card .cg_data {
	float:left;
	width:60%;
	height:100%;
}

.hot_cg .card .cg_card .cg_data .cg_name {
    font-size: 15px;
    font-weight: 600;
    color: #444;
    height: 18px;
    overflow: hidden;
    margin: 10px 0px 0px 10px;
}

.hot_cg .card .cg_card .cg_data .cg_says {
	color:#999;
	font-size:12px;
	height: 18px;
	overflow: hidden;
	margin: 3px 0px 0px 10px;
}

.hot_cg .card .cg_card .cg_data .cg_type {
	background-color: #8FC9EA;
    font-size: 12px;
    overflow: hidden;
    margin: 1px 0px 0px 10px;
    display: inline-block;
    padding: 1px 7px;
    color: #fff;
	border-radius: 2px;
}
');
?>
<div class="hot_cg_tip" title="热门茶馆"></div>

<div class="card">
<?php foreach ($hotCgList as $model): ?>
<a href="<?= Url::to(['/forum/m/u','u' => Html::encode($model['cgname'])],true) ?>" >
<div class="cg_card">
<img class="cg_head" src="<?=Yii::$app->params['cgPortraitHeaderUrl'].$model['cgmd5'] ?>"/>
<div class="cg_data">
<p class="cg_name"><?=Html::encode($model['cgname']) ?>馆</p>
<p class="cg_says"><?=Html::encode(@$model['cgdescr']) ?></p>

</div>
</div>
</a>
<?php endforeach ?>
</div>