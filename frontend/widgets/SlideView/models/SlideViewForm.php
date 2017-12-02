<?php
namespace app\widgets\SlideView\models;

use yii\base\Model;
use yii\db\Query;
use yii\db\Command;

/**
 * UploadForm is the model behind the upload form.
 */
class SlideViewForm extends Model
{
	public static function getCertThread($Num=4){
			
		$rows = (new Query())
			->select(['Id', 'post_title','post_content','uid','username','cgname'])
			->from('{{%cgthreads}}')
			->limit($Num)
			->where(["like","post_content",'class="td_pic"']) 
			->andwhere(['uid' => 1])//读取官方人员主题帖
			->all();
			
		return $rows;
		
	}
	
} 