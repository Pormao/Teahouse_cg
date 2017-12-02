<?php
namespace app\modules\forum\controllers;

use Yii;
use yii\web\Controller;
use app\models\CgDataForm;
use app\modules\forum\models\CgSettingsForm; 

class SettingsController extends Controller
{	
	
	public function actionIndex()
    {
		$get = Yii::$app->request->get();
		$post = Yii::$app->request->post();
		$session = Yii::$app->session;

		$cgDataModel = new CgDataForm;
		$cgSettingsModel = new CgSettingsForm;
		
		$cgData = $cgDataModel->getCgDataByCgmd5($get['cgnamemd5']);
		if(!Yii::$app->user->isGuest && $cgData['cg_createuid'] == Yii::$app->user->Id){
			
			if (isset($post['cgset'])){ //资料设置
				$cgSettingsModel->setCgDataByCgnamemd5(
					$post['cg_descr'],
					$post['cg_type'],
					$get['cgnamemd5']
				);
				$cgData = $cgDataModel->getCgDataByCgmd5($get['cgnamemd5']); //刷新资料
			}
			
		return $this->render('index',['post' => $post,'get' => $get,'cgData' => $cgData]);
		}
		
    }

}	