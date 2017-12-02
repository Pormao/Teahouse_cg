<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\Web\View;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $user \common\models\LoginForm */
/* @var $title string */

$this->registerCss('
.rankinglist {
	width:100%;
	height:auto;
	padding: 25px;
}

.rankinglist > p {
	margin:5px;
}

.rankinglist .ranktitle {
    color: rgb(78, 78, 78);
    font-size: 13px;
    width: 100%;
    clear: both;
    height: 30px;
    padding-top: 11px;
	font-weight:600;
    cursor: pointer;
}

.rankinglist .ranktitle:hover {
    background-color: #FDFFE9;
    padding-top: 11px;
}

.rankinglist .ranktitle > span {
	color: #fff;
    width: 18px;
    height: 18px;
    float: left;
	background-color: #D2D2D2;
    border-top-left-radius: 5px;
    border-bottom-right-radius: 5px;
    text-align: center;
    font-size: 13px;
    margin: 1px 10px;
}

.rankinglist .ranktitle .hot {
	background-color: #FF6666;
}
');
?>

<?php foreach ($rankList as $model): ?>
<a href="<?= Html::encode(Url::to(['/forum/m/p','t' => Yii::$app->params['postHeaderId']+$model['Id']],true)) ?>">
<div class="ranktitle text-ellipsis"><?php @$n++;if($n<4){echo '<span class="hot">'.$n;}else{echo '<span>'.$n;} ?>
</span>
<?= Html::encode($model['post_title']) ?>
</div>
</a>
<?php endforeach ?>