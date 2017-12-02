<?php
namespace frontend\models;

use yii\base\Model;
use yii\db\Query;
use yii\db\Command;

/**
 * UploadForm is the model behind the upload form.
 */
class SearchForm extends Model
{
	public static function SearchThreadList($searchContent,$Num=4){
			
		$rows = (new Query())
			->select(['Id', 'post_title','post_content','post_abstract','uid','username','cgname'])
			->from('{{%cgthreads}}')
			->where(['like','post_content',$searchContent])
			->orwhere(['like','post_title',$searchContent])
			->limit($Num)
			->all();
			
		return $rows;
		
	}
	
} 