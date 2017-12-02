<?php

namespace frontend\controllers\api\forum;

use Yii;
use yii\web\Controller;
use app\models\CgDataForm;
use app\models\CgThreadForm;
use app\models\UserDataForm;//用户资料表
use app\models\MessageForm;
use common\helpers\postApis;//帖子相关函数

class ThreadController extends Controller
{
	
	public function actions()
	{
		return [
			 'captcha' => [
				  'class' => 'yii\captcha\CaptchaAction',
                  'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                  'backColor'=>0xffffff,//背景颜色
                  'maxLength' => 5, //最大显示个数
                  'minLength' => 4,//最少显示个数
                  'padding' => 5,//间距
                  'height'=>40,//高度
                  'width' => 130,  //宽度  
                  'foreColor'=>0x000000,     //字体颜色
                  'offset'=>14,        //设置字符偏移量 有效果
                  //'controller'=>'thread',        //拥有这个动作的controller
			 ],
		 ];
	}
	
	public function actionVcode()
	{
		//Vcode
		if (Yii::$app->request->isAjax) {
		  $post = Yii::$app->request->post(); 
		  \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		  $session = Yii::$app->session;
		  
		  if(Yii::$app->user->isGuest){
			  return (['code' => 'lose','cause' => 'please Login']);
		  }
			 
			 
			if ($this->createAction('captcha')->validate($post['vcode'], false) == 1){
				$session['vcodeTime'] = time()+3600;
				return (['code' => 'success','cause' => $post['vcode']]);
			}else{
				return (['code' => 'lose','cause' => $post['vcode']]);
			}
			   
		}
	}
	
	public function actionGvs()
	{
		//GetVcodeState
		if (Yii::$app->request->isAjax) {
		  $post = Yii::$app->request->post();	  
		  \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;		  
		  $session = Yii::$app->session;
		  
		  if(Yii::$app->user->isGuest){
			  return (['code' => 'lose','cause' => 'please Login']);
		  }
			  
		  if($session['vcodeTime'] < time()) {
				return (['code' => 'lose','cause' => 'vcode is missing']);
			  }else{
				return (['code' => 'success','cause' => '520']);  
			  }
		  	 
		 } 
	}
	
	public function actionDrf()
	{
		//DeleteReplyFloor
		if (Yii::$app->request->isAjax) {
		  $post = Yii::$app->request->post(); 
		  \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		  
		  if(Yii::$app->user->isGuest){
			  return (['code' => 'lose','cause' => 'please Login']);
		  }
		  
		  $cgThreadModel = new CgThreadForm;
		  
		  if($cgThreadModel->deleteReplyFloor($post['rrid'],Yii::$app->user->identity->Id) !== 0){
			 $cgThreadModel->downThreadReplyFloor($post['rid']);
			 return (['code' => 'success','cause' => 1]);
		  }
		  
		}
	}
	
	public function actionDr()
	{
		//DeleteReply
		if (Yii::$app->request->isAjax) {
		  $post = Yii::$app->request->post(); 
		  \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		  
		  if(Yii::$app->user->isGuest){
			  return (['code' => 'lose','cause' => 'please Login']);
		  }
		  
		  $cgThreadModel = new CgThreadForm;
		  
		  if($cgThreadModel->deleteReply($post['rid'],Yii::$app->user->identity->Id) !==0){
			$cgThreadModel->downThreadFloor($post['tid']);
			return (['code' => 'success','cause' => 1]);
		  }
		  
		  
		}
	}
	
	public function actionDt()
	{
		//DeleteThread
		if (Yii::$app->request->isAjax) {
		  $post = Yii::$app->request->post(); 
		  \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		  
		  if(Yii::$app->user->isGuest){
			  return (['code' => 'lose','cause' => 'please Login']);
		  }
		  
		  $cgThreadModel = new CgThreadForm;
		  $cgmd5 = $cgThreadModel->getThreadData($post['tid'])['cgmd5'];
		  $result = $cgThreadModel->deleteThread($post['tid'],Yii::$app->user->identity->Id);
		  
		  if($result == true){
			  $cgDataModel = new CgDataForm;
			  $cgDataModel->downCgDataThreadNum($cgmd5);//减少帖子统计
			  return (['code' => 'success','cause' => 1]);
		  }else{
			  return (['code' => 'lose','cause' => 2]);
		  }
		  
		}
	}
	
	public function actionIrb()
	{
		//InsertReplyBuild
		if (Yii::$app->request->isAjax) {
		  $post = Yii::$app->request->post();
		  	  
		  \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;		  
		  
		  if(Yii::$app->user->isGuest){
			  return (['code' => 'lose','cause' => 'please Login']);
		  }
		  
		  $cgThreadModel = new CgThreadForm;
		  $userDataModel = new UserDataForm;
		  $messageModel = new MessageForm;
			  
		  if(Yii::$app->session['vcodeTime'] < time()) {return (['code' => 'lose','cause' => 'vcode is missing']);}
		   
		  $cgReplyData = $cgThreadModel->getReplyData($post['rid']); 
		   
		  if(!$cgReplyData){return false;}
		  
		  $receive_username = $userDataModel->getUserDataById($post['receive_uid'])['username']; //查询实际用户名
		  
		  #回复楼中楼#
		  $rrid = $cgThreadModel->insertReplyBuild(
			  $post['post_content'],
			  time(),
			  $cgReplyData['tid'],
			  $post['rid'],
			  Yii::$app->user->identity->Id,
			  Yii::$app->user->identity->username,
			  $post['receive_uid'],
			  $receive_username
		  );
		  $cgThreadModel->upThreadReplyFloor($post['rid']); //增加回复统计
	      #回复楼中楼#
		  
		  
		  #发送消息#
		  $messageModel->AddCgMessage(
				Yii::$app->user->identity->Id,
				Yii::$app->user->identity->username,
				$post['receive_uid'],
				$post['post_content'],
				Yii::$app->params['postHeaderId']+$cgReplyData['tid'],
				$post['rid'],
				$rrid
		);  
		  #发送消息#
		  
		  return (['code' => 'success','cause' => '1']);
		  	 
		 } 
	}
	
	public function actionGrb()
	{
		//GetReplyBuild
		if (Yii::$app->request->isAjax) {
			$post = Yii::$app->request->post();  
			\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;		  
			$cgThreadModel = new CgThreadForm;
			$userDataModel = new UserDataForm;	  
			$data = $cgThreadModel->getThreadReplyBuildList($post['rid'],@$post['page']);
			return (['code' => 'success','data' => $data,'cause' => '1']); 	 
		 } 
	}
}	