<?php
   namespace app\widgets\Follow;
   use yii\base\Widget;
   use Yii;
   use app\models\CgFollowForm;
   
   class FollowList extends Widget {
	  public $uid;
	  public function run() {
		  
		 $cgFollowModel = new CgFollowForm;
		 $followList = $cgFollowModel->getFollowList($this->uid);
		 
		 return $this->render('followList',['followList' => $followList]);
      }
	  
   }
?> 