<?php
namespace app\widgets\RankList\models;

use yii\base\Model;
use yii\db\Query;
use yii\db\Command;

/**
 * UploadForm is the model behind the upload form.
 */
class RankListForm extends Model
{
	public static function getRankList($Num=10){
			
		$rows = (new Query())
			->select(['Id', 'post_title','post_floor_num'])
			->from('{{%cgthreads}}')
			->limit($Num)
			->orderBy(['post_floor_num' => SORT_DESC])
			->all();
			
		return $rows;
		
	}
	
} 