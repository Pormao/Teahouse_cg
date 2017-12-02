<?php
   namespace app\widgets\AvatorUpload;
   use yii\base\Widget;
   use Yii;
   use app\widgets\AvatorUpload\models\UploadForm;
   use yii\web\UploadedFile;
   use common\helpers\commonFunctionApis;//普通相关函数
   use app\models\UserDataForm;//用户资料表
   
   class AvatorUpload extends Widget {
	  public $defaultImgUrl;
	   
      public function init() {
         parent::init();
         ob_start();
      }
      public function run() {
		 $uploadModel = new UploadForm();
		 $post = Yii::$app->request->post();
		 	 
		 if (Yii::$app->request->isPost && !Yii::$app->user->isGuest) {
            $uploadModel->file = UploadedFile::getInstance($uploadModel, 'file');
			
            if ($uploadModel->file && $uploadModel->validate()) {
				
				$fileName = md5(commonFunctionApis::createGuid()).'.'. $uploadModel->file->extension; //通过guid配合md5生成文件名
                $uploadModel->file->saveAs('data/avator/'.$fileName);
				
				$userDataModel = new UserDataForm;
				$userDataModel->updataHeadById(Yii::$app->user->identity->Id,$fileName); //同步数据库记录
				
            }
			
        }
		 
		 return $this->render('avatorUpload',['defaultImgUrl' => $this->defaultImgUrl,'uploadModel'=> $uploadModel]);
      }
   }
?> 