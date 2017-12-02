<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->registerCss('
.exp_block {
	margin-left: 15px;
}	
	
.exp_bar {
    width: 100%;
    height: 2px;
    border: 1px solid #F3BA52;
	background-color: #FFF9DB;
    overflow: hidden;
    margin: 5px auto;
}

.exp_bar .exp {
    width: 50%;
    height: 100%;
    background-color: #F5DA5A;
}

.exp_bar .exp_num {
    margin: -2px auto;
    text-align: center;
    color: #A75222;
    font-size: 12px;
    position: absolute;
    width: 255px;
    margin-top: -14px;
}
');
?>
<div class="exp_bar">
<div class="exp" style="width:<?= $percent ?>%"></div>
<div class="exp_num"><?= $exp.'/'.$upExp ?></div>
</div>
