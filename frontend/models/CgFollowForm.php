<?php

namespace app\models;

use Yii;
use yii\base\Model;
use common\models\Cgdata;
use yii\db\Query;
use yii\db\Command;
use yii\db\Expression;

class CgFollowForm extends Model
{
    
	public static function setFollow($follow,$cgid,$cgname,$uid,$time)
	{
		if(CgFollowForm::getFollowData($cgid,$uid)){
			$params = [':follow' => $follow,':cgid' => $cgid,':uid' => $uid];
			Yii::$app->db
			->createCommand("UPDATE {{%cgfollow}} SET follow=:follow WHERE uid=:uid AND cgid=:cgid",$params)
			->execute();
			return $follow;
		}else{
			CgFollowForm::insertFollow($cgid,$cgname,$uid,$time);
			return 1;
		}
	}
	
	public static function insertFollow($cgid,$cgname,$uid,$time)
	{
		return Yii::$app->db
		->createCommand()->insert('{{%cgfollow}}', [
			'cgid' => $cgid,
			'cgname' => $cgname,
			'uid' => $uid,
			'exp' => '5',
			'join_time' => $time, 
			'follow' => '1'
		])->execute();
	}
	
	public static function getFollowData($cgid,$uid)
	{
        return ($rows = (new Query())
			->select(['Id','exp','follow'])
			->from('{{%cgfollow}}')
			->where(['uid' => $uid,'cgid' => $cgid])
			->limit(1)
			->one()
		);		
	}
	
	public static function getFollowList($uid){
		return ($rows = (new Query())
			->select(['cgid','cgname','exp','follow'])
			->from('{{%cgfollow}}')
			->where(['uid' => $uid, 'follow' => '1'])
			->all()
		);	
	}

}
