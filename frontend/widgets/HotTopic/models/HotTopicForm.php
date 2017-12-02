<?php
namespace app\widgets\HotTopic\models;

use yii\base\Model;
use yii\db\Query;
use yii\db\Command;

/**
 * UploadForm is the model behind the upload form.
 */
class HotTopicForm extends Model
{
	public static function getHotTopicList($Num=4){
			
		$rows = (new Query())
			->select(['Id', 'post_title','post_content','post_abstract','uid','username','cgname'])
			->from('{{%cgthreads}}')
			->limit($Num)
			->orderBy(['post_floor_num' => SORT_DESC])
			->all();
			
		return $rows;
		
	}
	
	public static function getHotTopicView($Num=3){
			
		$rows = (new Query())
			->select(['Id', 'post_title','post_content','uid','username','cgname'])
			->from('{{%cgthreads}}')
			->limit($Num)
			->where(["like","post_content",'class="td_pic"']) 
			->all();
			
		return $rows;
		
	}
} 