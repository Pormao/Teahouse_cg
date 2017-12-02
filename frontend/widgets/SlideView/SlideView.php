<?php
   namespace app\widgets\SlideView;
   use yii\base\Widget;
   use Yii;
   use app\widgets\SlideView\models\SlideViewForm;
   use yii\caching\FileCache;
   
   class SlideView extends Widget {
      public function run() {
		 $SlideViewModel = new SlideViewForm;
		 
		 $FileCache = new FileCache;
		 $FileCache->flush();
		 $certThreadList = $FileCache->get('CertThreadListCache');
			if ($certThreadList === false) {
				$certThreadList = $SlideViewModel->getCertThread();
				$FileCache->set('CertThreadListCache',$certThreadList,60*5); //缓存5分钟
			}
		 return $this->render('slideView',['certThreadList' => $certThreadList]);
      }
   }
?> 