<?php
namespace app\modules\forum\controllers;

use Yii;
use yii\web\Controller;
use app\models\CgDataForm;
use app\modules\forum\models\CgCreateForm; 

use yii\filters\AccessControl;

class CreatecgController extends Controller
{	
	
	public function actionIndex()
    {
		if (!Yii::$app->user->isGuest){
		$get = Yii::$app->request->get();
		$post = Yii::$app->request->post();
		$session = Yii::$app->session;
		$cgDataModel = new CgDataForm;	//资料模型
		$cgCreateModel = new CgCreateForm;	//创建模型
		
		$cgnamemd5 = md5(@$post['cg_name']);
		
		
		###### Step 1 ######
		if (isset($post['cgcreate'])){ //茶馆创建
			$cgData = $cgDataModel->getCgData($cgnamemd5);
			
			if(!$cgData){
				$cgCreateModel->createCg(
					$post['cg_name'],
					$post['cg_descr'],
					Yii::$app->params['cgType'][$post['cg_type']],
					Yii::$app->user->identity->Id,
					time(),
					$cgnamemd5
				);
				
				$this->redirect(array('/forum/createcg/upload','cgnamemd5'=>$cgnamemd5));
			}
		}
		
		return $this->render('index',[
		'post' => $post,
		'get' => $get,
		]);
		
		}
    }
	
	public function actionUpload()
    {
		$get = Yii::$app->request->get();
		$post = Yii::$app->request->post();
		
		if (isset($post['cgcreate2'])){ //头像上传
			return $this->render('complate');
		}
		
		
		return $this->render('uploadHead',['get' => $get,'post' => $post]);
	}
	
}	