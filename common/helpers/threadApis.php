<?php
namespace common\helpers;

use Yii;
use yii\helpers\Url;
use app\models\CgThreadForm;
/*
 * 自定义全局公共方法
 */
class threadApis{
	
	public static function createUrl($tid,$rid,$rrid){
		 $cgThreadModel = new CgThreadForm;
		 $page = $cgThreadModel->getThreadReplyPage($rid);
		 $page_2 = $cgThreadModel->getBuildReplyPage($rrid);
		 
		 $tid = $tid + Yii::$app->params['postHeaderId'];
		 $rid = $rid + Yii::$app->params['postReplyHeaderId'];
		 
		 if($rrid == 0){
			 $url = Url::to(['/forum/m/p','t'=> $tid,'pg'=>$page],true);
		 }else{
			 $url = Url::to(['/forum/m/p','t'=> $tid,'pg'=>$page,'f'=>$page_2],true);
		 }
		 return $url.'#r'.$rid;
	  }
	  
}
