<?php
   namespace app\widgets\UserAvatorUpload;
   use yii\base\Widget;
   use Yii;
   use app\widgets\UserAvatorUpload\models\UserUploadForm;
   use yii\web\UploadedFile;
   use common\helpers\commonFunctionApis;//普通相关函数
   use app\models\UserDataForm;//用户资料表
   
   class UserAvatorUpload extends Widget {
	  public $defaultImgUrl;
	   
      public function init() {
         parent::init();
         ob_start();
      }
      public function run() {
		 $userUploadModel = new UserUploadForm();
		 $post = Yii::$app->request->post();
		 	 
		 if (Yii::$app->request->isPost && !Yii::$app->user->isGuest) {
            $userUploadModel->file = UploadedFile::getInstance($userUploadModel, 'file');
			
            if ($userUploadModel->file && $userUploadModel->validate()) {
				
				$fileName = md5(commonFunctionApis::createGuid()).'.'. $userUploadModel->file->extension; //通过guid配合md5生成文件名
                $userUploadModel->file->saveAs('data/user/avator/'.$fileName);
				
				$userDataModel = new UserDataForm;
				$userDataModel->updataHeadById(Yii::$app->user->identity->Id,$fileName); //同步数据库记录
				
            }
			
        }
		 
		 return $this->render('userAvatorUpload',['defaultImgUrl' => $this->defaultImgUrl,'userUploadModel'=> $userUploadModel]);
      }
   }
?> 