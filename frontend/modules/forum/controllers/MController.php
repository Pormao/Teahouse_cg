<?php
namespace app\modules\forum\controllers;

use Yii;
use yii\web\Controller;
use app\models\CgDataForm;
use app\models\CgThreadForm;
use app\models\MessageForm;
use common\helpers\postApis;//帖子相关函数

use yii\filters\AccessControl;

class MController extends Controller
{	
	
	public function actionU()
    {
		$get = Yii::$app->request->get();
		$post = Yii::$app->request->post();
		$session = Yii::$app->session;
		
		$cgnamemd5 = md5(@$get['u']);
		
		$cgDataModel = new CgDataForm;	//资料模型
		$cgThreadModel = new CgThreadForm;	//帖子操作模型
		
		if (isset($post['cgpublish']) && !Yii::$app->user->isGuest){
			
			if($session['vcodeTime'] < time()){
				echo '<script>window.onload=function(){loadvcode();}</script>';
			}else{
				
				#发表话题#
				$cgThreadModel->sendThread(
				Yii::$app->user->identity->Id,
				Yii::$app->user->identity->username,
				$post['title'],
				postApis::cutArticle($post['content'],100),
				$post['content'],
				time(),
				$get['u'],
				$cgnamemd5
				);
				#发表话题#
			}
			
			$cgDataModel->upCgDataThreadNum($cgnamemd5); //增加贴数统计
		}
		
		$cgdata = $cgDataModel->getCgData($cgnamemd5);	
		$cgThreadsList = $cgThreadModel->getThreadsList($cgnamemd5,@$get['pg'],10);
		$cgThreadsCount = $cgThreadModel->getThreadCount($cgnamemd5);
		return $this->render('cgMain',[
		'cgnamemd5' => $cgnamemd5,
		'cgdata' => $cgdata,
		'cgThreadsList' => $cgThreadsList,
		'cgThreadsCount' => $cgThreadsCount,
		'get' => $get,
		'post' => $post
		]);
    }

    public function actionP()
	{
		$get = Yii::$app->request->get();
		$post = Yii::$app->request->post();
		$session = Yii::$app->session;
		
		$cgThreadModel = new CgThreadForm;
		$messageModel = new MessageForm;	//消息操作模型
		
		$cgThreadData = $cgThreadModel->getThreadData($get['t']);
		//return $cgThreadModel->getThreadReplyPage(122);
		if(!$cgThreadData){
			return '帖子被风吹走了~';
		}
		
		if (isset($post['cgreply']) && !Yii::$app->user->isGuest){		
			if($session['vcodeTime'] < time()){
				echo '<script>window.onload=function(){loadvcode();}</script>';
			}
			else
			{
				#回复帖子#
				$rid = $cgThreadModel->replyThread(
					Yii::$app->user->identity->Id,
					Yii::$app->user->identity->username,
					$post['content'],
					time(),
					$get['t']
				);
				#回复帖子#
				
				$cgThreadData = $cgThreadModel->getThreadData($get['t']);
				
				$cgThreadModel->updateThreadUpdateTime($get['t'],time()); //刷新帖子回复时间
				$cgThreadModel->upThreadFloor($get['t']); //增加帖子楼层数	 
				
				#发送消息#
				$messageModel->AddCgMessage(
					Yii::$app->user->identity->Id,
					Yii::$app->user->identity->username,
					$cgThreadData['uid'],
					$post['content'],
					$get['t'],
					Yii::$app->params['postReplyHeaderId']+$rid,
					0
				); 
				#发送消息#
				
			}
		}	
		
		$cgThreadData = $cgThreadModel->getThreadData($get['t']);
		$cgThreadsBuild = $cgThreadModel->getThreadReplyList($get['t'],@$get['pg']);
		$cgThreadsReplyCount = $cgThreadModel->getThreadReplyCount($get['t']);
		
        return $this->render('cgThread',[
			'cgThreadData' => $cgThreadData,
			'cgThreadsBuild' => $cgThreadsBuild,
			'get' => $get,
			'post' => $post,
			'cgThreadsReplyCount' => $cgThreadsReplyCount
		]);
    }
	
	
}	