<?php

namespace frontend\controllers\api\forum;

use Yii;
use yii\web\Controller;
use app\models\CgDataForm;
use app\models\CgFollowForm;

class FollowController extends Controller
{
	public function actionFc()
	{
		//FollowCg
		if (Yii::$app->request->isAjax) {
		  $post = Yii::$app->request->post(); 
		  \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		  
		  if(Yii::$app->user->isGuest){
			  return (['code' => 'lose','cause' => 'please Login']);
		  }
		  
		  $cgDataModel = new CgDataForm;
		  $cgData = $cgDataModel->getCgDataById($post['cgid']);
		  
		  if(!$cgData){
			  return (['code' => 'lose','cause' => 'cgid is lose!']);
		  }
		  
		  
		  $cgFollowModel = new CgFollowForm;
		  $result = $cgFollowModel->setFollow($post['follow'],$post['cgid'],$cgData['cgname'],Yii::$app->user->identity->Id,time());
		 
		 if($result == 1){
			  $cgDataModel->upCgDataFollowNum($cgData['cgmd5']);
		  }else{
			  $cgDataModel->downCgDataFollowNum($cgData['cgmd5']);
		  }
		  
		  return (['code' => 'success','cause' => $result]);
		  
		}
	}
	
}	