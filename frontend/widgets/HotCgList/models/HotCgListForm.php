<?php
namespace app\widgets\HotCgList\models;

use yii\base\Model;
use yii\db\Query;
use yii\db\Command;

/**
 * UploadForm is the model behind the upload form.
 */
class HotCgListForm extends Model
{
	public static function getHotCgList($Num=4){
			
		$rows = (new Query())
			->select(['Id', 'cgname','cgdescr','cgmd5'])
			->from('{{%cgdata}}')
			->limit($Num)
			->orderBy(['cg_thread_num' => SORT_DESC])
			->all();
			
		return $rows;
		
	}
	
} 