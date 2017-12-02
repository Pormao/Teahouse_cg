<?php

namespace app\models;

use Yii;
use yii\base\Model;
use common\models\Cgdata;
use yii\db\Query;
use yii\db\Command;
use yii\db\Expression;

class CgThreadForm extends Model
{
    public $verifyCode;
    public function rules()
    {
        return [
            ['verifyCode', 'required'],
            ['verifyCode', 'captcha'],
        ];
    }

	public function attributeLabels()
    {
        return [
             'verifyCode' => 'test', //验证码的名称，根据个人喜好设定
        ];
    }

	public static function deleteReplyFloor($rrid,$uid)
	{

		return Yii::$app->db->createCommand()->delete('{{%cgthread_reply_floor}}', ['Id' => $rrid, 'send_uid' => $uid])->execute();
	}

	public static function deleteReply($rid,$uid)
	{
		$rid = $rid - Yii::$app->params['postReplyHeaderId'];

		$result = Yii::$app->db->createCommand()->delete('{{%cgthread_reply}}', ['Id' => $rid,'uid' => $uid])->execute();
		Yii::$app->db->createCommand()->delete('{{%cgthread_reply_floor}}', ['rid' => $rid])->execute();
		return $result;
	}

    public static function deleteThread($id,$uid)
	{
		$id = $id - Yii::$app->params['postHeaderId'];

		$result = Yii::$app->db->createCommand()->delete('{{%cgthreads}}', [
			'Id' => $id,
			'uid' => $uid
			])->execute();

		if($result == 0){
			return false;
		}else{
			$rows = (new Query()) //查询楼中楼宿主
			->select(['Id'])
			->from('{{%cgthread_reply}}')
			->where(['tid' => $id])
			->one();

			Yii::$app->db->createCommand()->delete('{{%cgthread_reply}}', ['tid' => $id])->execute(); //删除回复
			Yii::$app->db->createCommand()->delete('{{%cgthread_reply_floor}}', ['rid' => $rows['Id']])->execute(); //删除楼中楼
			return true;
		}

	}

	public static function getThreadsList($cgnamemd5,$page=1,$pageNum=3)
    {
        $page=$page-1;

		return ($rows = (new Query())
			->select(['Id', 'post_title','post_abstract','post_content','post_time','post_floor_num','cgname','uid','username'])
			->from('{{%cgthreads}}')
			->where(['cgmd5' => $cgnamemd5])
			->offset($page*$pageNum)
			->limit($pageNum)
			->orderBy(['update_time' => SORT_DESC])
			->all()
		);
    }

	public static function getThreadCount($cgnamemd5)
    {
		return ($count = (new Query())
			->from('{{%cgthreads}}')
			->where(['cgmd5' => $cgnamemd5])
			->count()
		);
    }

	public static function sendThread($uid,$username,$title,$abstract,$content,$time,$cgname,$cgmd5)
	{
		return Yii::$app->db
			->createCommand()->insert('{{%cgthreads}}', [
			'uid' => $uid,
			'username' => $username,
			'post_title' => $title,
			'post_abstract' => $abstract,
			'post_content' => $content,
			'post_time' => $time,
			'update_time' => $time,
			'post_floor_num' => 0,
			'cgname' => $cgname,
			'cgmd5' => $cgmd5
			])->execute();

	}

	public static function updateThreadUpdateTime($Id,$time)
	{
		$Id = $Id - Yii::$app->params['postHeaderId'];
		Yii::$app->db->createCommand("lock tables {{%cgthreads}} WRITE")->execute();
		$result = Yii::$app->db->createCommand("UPDATE {{%cgthreads}} SET update_time=".$time." WHERE Id='".$Id."'")->execute();
		Yii::$app->db->createCommand("unlock tables")->execute();
		return $result;
	}

	public static function getThreadData($Id)
	{
		$Id = $Id - Yii::$app->params['postHeaderId'];
        return ($rows = (new Query())
			->select(['post_title','post_content','post_time','uid','username','cgname','cgmd5'])
			->from('{{%cgthreads}}')
			->where(['Id' => $Id])
			->limit(1)
			->one()
		);
	}
	
	public static function getReplyData($Id)
	{
		$Id = $Id - Yii::$app->params['postReplyHeaderId'];
        return ($rows = (new Query())
			->select(['post_content','post_time','tid'])
			->from('{{%cgthread_reply}}')
			->where(['Id' => $Id])
			->limit(1)
			->one()
		);
	}
	
	public static function replyThread($uid,$username,$content,$time,$tid)
	{
		$tid = $tid - Yii::$app->params['postHeaderId'];
		
		Yii::$app->db->createCommand("lock tables {{%cgthreads}} READ , {{%cgthread_reply}} WRITE")->execute();
		$rows = (new Query())
			->select(['post_floor_num'])
			->from('{{%cgthreads}}')
			->where(['Id' => $tid])
			->limit(1)
			->one();
		
		Yii::$app->db
		->createCommand()->insert('{{%cgthread_reply}}', [
			'uid' => $uid,
			'username' => $username,
			'post_content' => $content,
			'post_time' => $time,
			'post_floor' => ($rows['post_floor_num'])+1,
			'tid' => $tid
		])->execute();  
		
		$rid = Yii::$app->db->getLastInsertID();
		Yii::$app->db->createCommand("unlock tables")->execute();
		
		return $rid;//返回rid

	}

	public static function insertReplyBuild($content,$time,$tid,$rid,$send_uid,$send_username,$receive_uid,$receive_username)
	{
		$rid = $rid - Yii::$app->params['postReplyHeaderId'];
		
		Yii::$app->db->createCommand("lock tables {{%cgthread_reply}} READ , {{%cgthread_reply_floor}} WRITE")->execute();
		$rows = (new Query())
			->select(['post_floor_num'])
			->from('{{%cgthread_reply}}')
			->where(['Id' => $rid])
			->limit(1)
			->one();
		
		Yii::$app->db
		->createCommand()->insert('{{%cgthread_reply_floor}}', [
			'post_content' => $content,
			'post_time' => $time,
			'post_floor' => ($rows['post_floor_num'])+1,
			'tid' => $tid,
			'rid' => $rid,
			'send_uid' => $send_uid,
			'send_username' => $send_username,
			'receive_uid' => $receive_uid,
			'receive_username' => $receive_username
		])->execute();
		
		$rrid = Yii::$app->db->getLastInsertID();
		Yii::$app->db->createCommand("unlock tables")->execute();
		
		return $rrid;//返回rrid
	}

	public static function getThreadReplyList($tid,$page=1)
    {
        $tid = $tid - Yii::$app->params['postHeaderId'];
		$page=$page-1;
		$pageNum = 9; //层数

		return ($rows = (new Query())
			->select(['Id', 'uid','username','post_content','post_floor_num','post_time'])
			->from('{{%cgthread_reply}}')
			->where(['tid' => $tid])
			->offset($page*$pageNum)
			->limit($pageNum)
			->orderBy(['Id' => SORT_ASC])
			->all()
		);
    }

	public static function getThreadReplyCount($tid)
    {
        $tid = $tid - Yii::$app->params['postHeaderId'];
		return ($count = (new Query())
			->from('{{%cgthread_reply}}')
			->where(['tid' => $tid])
			->count()
		);
    }
	
	public static function getThreadReplyPage($rid)
	{
		$pageNum = 9;
		$rows = (new Query())
			->select(['tid'])
			->from('{{%cgthread_reply}}')
			->where(['Id' => $rid])
			->one();
		$count = (new Query())
			->from('{{%cgthread_reply}}')
			->where(['tid' => $rows['tid']])
			->andWhere(['<','Id',$rid])
			->count();
		
		if(($page = ceil($count/($pageNum-1)))==0){$page=1;}
		return $page;
	}
	
	public static function getBuildReplyPage($rrid)
	{
		$pageNum = 4;
		$rows = (new Query())
			->select(['rid'])
			->from('{{%cgthread_reply_floor}}')
			->where(['Id' => $rrid])
			->one();
		$count = (new Query())
			->from('{{%cgthread_reply_floor}}')
			->where(['rid' => $rows['rid']])
			->andWhere(['<','Id',$rrid])
			->count();
		
		if(($page = ceil($count/($pageNum-1)))==0){$page=1;}
		return $page;
	}
	
	public static function getThreadReplyBuildList($rid,$page=1)
    {
        $rid = $rid - Yii::$app->params['postReplyHeaderId'];
		$page=$page-1;
		$pageNum = 4; //层数

		return ($rows = (new Query())
			->select(['Id','post_content','post_time','send_uid','send_username','receive_uid','receive_username'])
			->from('{{%cgthread_reply_floor}}')
			->where(['rid' => $rid])
			->offset($page*$pageNum)
			->limit($pageNum)
			->orderBy(['Id' => SORT_ASC])
			->all()
		);
    }

	public static function upThreadFloor($Id)
	{
		$Id = $Id - Yii::$app->params['postHeaderId'];
		Yii::$app->db->createCommand("lock tables {{%cgthreads}} WRITE")->execute();
		$result = Yii::$app->db->createCommand("UPDATE {{%cgthreads}} SET post_floor_num=".new Expression("`post_floor_num` + 1")." WHERE Id='".$Id."'")->execute();
		Yii::$app->db->createCommand("unlock tables")->execute();
		return $result;
	}

	public static function downThreadFloor($Id)
	{
		$Id = $Id - Yii::$app->params['postHeaderId'];
		Yii::$app->db->createCommand("lock tables {{%cgthreads}} WRITE")->execute();
		$result = Yii::$app->db->createCommand("UPDATE {{%cgthreads}} SET post_floor_num=".new Expression("`post_floor_num` - 1")." WHERE Id='".$Id."'")->execute();
		Yii::$app->db->createCommand("unlock tables")->execute();
		return $result;
	}

	public static function upThreadReplyFloor($Id)
	{
		$Id = $Id - Yii::$app->params['postReplyHeaderId'];
		Yii::$app->db->createCommand("lock tables {{%cgthread_reply}} WRITE")->execute();
		$result = Yii::$app->db->createCommand("UPDATE {{%cgthread_reply}} SET post_floor_num=".new Expression("`post_floor_num` + 1")." WHERE Id='".$Id."'")->execute();
		Yii::$app->db->createCommand("unlock tables")->execute();
		return $result;
	}

	public static function downThreadReplyFloor($Id)
	{
		$Id = $Id - Yii::$app->params['postReplyHeaderId'];
		Yii::$app->db->createCommand("lock tables {{%cgthread_reply}} WRITE")->execute();
		$result = Yii::$app->db->createCommand("UPDATE {{%cgthread_reply}} SET post_floor_num=".new Expression("`post_floor_num` - 1")." WHERE Id='".$Id."'")->execute();
		Yii::$app->db->createCommand("unlock tables")->execute();
		return $result;
	}

}
