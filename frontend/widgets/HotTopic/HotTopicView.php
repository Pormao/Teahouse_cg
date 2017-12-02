<?php
   namespace app\widgets\HotTopic;
   use yii\base\Widget;
   use Yii;
   use app\widgets\HotTopic\models\HotTopicForm;
   use yii\caching\FileCache;
   
   class HotTopicView extends Widget {
	  public $viewNum;
	  
      public function run() {
		 $HotTopicModel = new HotTopicForm;
		 $FileCache = new FileCache;
		 $hotTopicView = $FileCache->get('HotTopicViewCache');
			if ($hotTopicView === false) {
				$hotTopicView = $HotTopicModel->getHotTopicView($this->viewNum);
				$FileCache->set('HotTopicViewCache',$hotTopicView,60*5); //缓存5分钟
			} 
		 return $this->render('hotTopicView',['hotTopicView' => $hotTopicView]);
      }
   }
?> 