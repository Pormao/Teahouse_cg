<?php
   namespace app\widgets\CgPortraitUpload;
   use yii\base\Widget;
   use Yii;
   use app\widgets\CgPortraitUpload\models\CgUploadForm;
   use yii\web\UploadedFile;
   use common\helpers\commonFunctionApis;//普通相关函数
   use app\models\CgDataForm;//资料表
   
   class CgAvatorUpload extends Widget {
	  public $defaultImgUrl;
	  public $cgnamemd5;
	   
      public function init() {
         parent::init();
         ob_start();
      }
      public function run() {
		 $cgUploadModel = new CgUploadForm();
		 $cgDataModel = new CgDataForm;
		 $post = Yii::$app->request->post();
		 
		 $cgData = $cgDataModel->getCgData($this->cgnamemd5);
		 
		 if (Yii::$app->request->isPost && !Yii::$app->user->isGuest && $cgData['cg_createuid'] == Yii::$app->user->identity->Id) {
            $cgUploadModel->file = UploadedFile::getInstance($cgUploadModel, 'file');
			
            if ($cgUploadModel->file && $cgUploadModel->validate()) {
				
				$fileName = md5(commonFunctionApis::createGuid()).'.'. $cgUploadModel->file->extension; //通过guid配合md5生成文件名
                $cgUploadModel->file->saveAs('data/cg/avator/'.$fileName);
				$cgUploadModel->updataHeadByCgmd5($this->cgnamemd5,$fileName); //同步数据库记录
				
            }
			
        }
		 
		 return $this->render('cgAvatorUpload',['defaultImgUrl' => $this->defaultImgUrl,'cgUploadModel'=> $cgUploadModel]);
      }
   }
?> 