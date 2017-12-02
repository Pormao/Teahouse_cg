<?php
   namespace app\widgets\HotCgList;
   use yii\base\Widget;
   use Yii;
   use app\widgets\HotCgList\models\HotCgListForm;
   use yii\caching\FileCache;
   
   class HotCgList extends Widget {
      public function run() {
		 $HotCgListModel = new HotCgListForm;
		 
		 $FileCache = new FileCache;
		 
		 $hotCgList = $FileCache->get('HotCgListCache');
			if ($hotCgList === false) {
				$hotCgList = $HotCgListModel->getHotCgList(3);
				$FileCache->set('HotCgListCache',$hotCgList,60*5); //缓存5分钟
			}
		 return $this->render('hotCgList',['hotCgList' => $hotCgList]);
      }
   }
?> 