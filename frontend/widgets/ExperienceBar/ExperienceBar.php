<?php
   namespace app\widgets\ExperienceBar;
   use yii\base\Widget;
   use Yii;
   use common\helpers\levelApis;//等级相关函数
   
   class ExperienceBar extends Widget {
	  public $exp;
	   
      public function run() {
		 $exp = $this->exp;
		 $upExp = levelApis::calLevelExp(levelApis::calLevel($exp)+1);
		 $expPercent = ($exp/$upExp)*100;
		 
		 return $this->render('experienceBar',[
		 'exp' => $exp,
		 'upExp' => $upExp,
		 'percent' => $expPercent
		 ]);
      }
	  
   }
?> 