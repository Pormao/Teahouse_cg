<?php
   namespace app\widgets\RankList;
   use yii\base\Widget;
   use Yii;
   use app\widgets\RankList\models\RankListForm;
   use yii\caching\FileCache;
   
   class RankList extends Widget {
      public function run() {
		 $RankListModel = new RankListForm;
		 
		 $FileCache = new FileCache;
		 
		 $rankList = $FileCache->get('RankListCache');
			if ($rankList === false) {
				$rankList = $RankListModel->getRankList(7);
				$FileCache->set('RankListCache',$rankList,60*5); //缓存5分钟
			}
		 return $this->render('rankList',['rankList' => $rankList]);
      }
   }
?> 