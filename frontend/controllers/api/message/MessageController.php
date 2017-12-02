<?php

namespace frontend\controllers\api\message;

use Yii;
use yii\web\Controller;
use app\models\MessageForm;
use common\helpers\threadApis;//贴相关函数

class MessageController extends Controller
{
	
	public function actionGml()
	{
		//GetMessagesList
		if (Yii::$app->request->isAjax) {
		  $post = Yii::$app->request->post(); 
		  \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		  
		  if(Yii::$app->user->isGuest){
			  return (['code' => 'lose','cause' => 'please Login']);
		  }
		  
		  $MessageModel = new MessageForm;
		  $msgsList = $MessageModel->getCgMsgsListById(Yii::$app->user->identity->Id,@$post['page']);
		  
		  if(!$msgsList){
			  return (['code' => 'lose','cause' => 'nothing more']);
		  }
		  
		  $arr = array();
		  foreach($msgsList as $model){ 
			$arr[]=array(
			'Id' => $model['id'],
			'uid' => $model['send_uid'],
			'username' => $model['send_username'],
			'content' => $model['post_content'],
			'url' => threadApis::createUrl($model['tid'],$model['rid'],$model['rrid']),
			);
		  }
		  
		  
		  
		  return (['code' => 'success','data' => $arr]);
		  
		}
	}
	
}	