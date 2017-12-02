<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
/* @var $this \yii\web\View */
/* @var $user \common\models\LoginForm */
/* @var $title string */
$this->registerCss('
.pagebar {
    margin: 10px 15px;
    cursor: default;
    width: 97%;
}
.pagebar a {
    padding: 1px 6px;
    cursor: pointer;
    color: #92B4E2;
    font-size: 13px;
    font-weight: 600;
    float: left;
    margin-right: 10px;
}
.pagebar .page {
    border-bottom: 2px solid #4E97D0;
    color: #4E97D0;
}
.pagebar .all-page-num {
	font-size: 14px;
    color: #83929C;
    float: left;
}
.pagebar .all-page-num span {
    color: #E66464;
    margin-left: 5px;
    font-size: 12px;
}
');
?>
<div class="pagebar">
<div class="all-page-num">总页数:<span><?= Html::encode($allPageNum) ?></span></div>
<div style="float:right"><?= $pageList ?></div>
<div class="clear"></div>
</div>