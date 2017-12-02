<?php
   namespace app\widgets\HotTopic;
   use yii\base\Widget;
   use Yii;
   use app\widgets\HotTopic\models\HotTopicForm;
   use yii\caching\FileCache;
   
   class HotTopicList extends Widget {
      public function run() {
		 $HotTopicModel = new HotTopicForm;
		 $FileCache = new FileCache;
		 $hotTopicList = $FileCache->get('HotTopicListCache');
			if ($hotTopicList === false) {
				$hotTopicList = $HotTopicModel->getHotTopicList(10);
				$FileCache->set('HotTopicListCache',$hotTopicList,60*5); //缓存5分钟
			} 
		 return $this->render('hotTopicList',['hotTopicList' => $hotTopicList]);
      }
   }
?> 