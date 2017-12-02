<?php
   namespace app\widgets\Follow;
   use yii\base\Widget;
   use Yii;
   use app\models\CgFollowForm;
   
   class Follow extends Widget {
	  public $cgid;
	  public function run() {
		  
		 $cgFollowModel = new CgFollowForm;
		 
		 $follow = $cgFollowModel->getFollowData($this->cgid,Yii::$app->user->identity->Id)['follow'];
		 
		 return $this->render('follow',['follow' => $follow]);
      }
	  
   }
?> 