<?php

namespace app\models;

use Yii;
use yii\base\Model;
use common\models\Cgdata;
use yii\db\Query;
use yii\db\Command;
use yii\db\Expression;

class MessageForm extends Model
{
    public static function getCgMsgsListById($uid,$page=1,$pageNum=3)
    {
        $page=$page-1;

		return ($rows = (new Query())
			->select(['id', 'send_uid','send_username','post_content','tid','rid','rrid'])
			->from('{{%cgmessage}}')
			->where(['receive_uid' => $uid])
			->offset($page*$pageNum)
			->limit($pageNum)
			->orderBy(['Id' => SORT_DESC])
			->all()
		);
    }
	
	public static function getCgMessageCount($uid)
    {
		return ($count = (new Query())
			->from('{{%cgmessage}}')
			->where(['receive_uid' => $uid])
			->count()
		);
    }
	
	public static function AddCgMessage($send_uid,$send_username,$receive_uid,$content,$tid,$rid,$rrid)
	{
		$tid = $tid - Yii::$app->params['postHeaderId'];
		$rid = $rid - Yii::$app->params['postReplyHeaderId'];
		return Yii::$app->db
		->createCommand()->insert('{{%cgmessage}}', [
		'send_uid' => $send_uid,
		'send_username' => $send_username,
		'receive_uid' => $receive_uid,
		'post_content' => $content,
		'tid' => $tid,
		'rid' => $rid,
		'rrid' => $rrid
		])->execute();
	}

}
