<?php

namespace app\models;

use Yii;
use yii\base\Model;
use common\models\Cgdata;
use yii\db\Query;
use yii\db\Command;
use yii\db\Expression;

class CgDataForm extends Model
{
    public $u;

    public function rules()
    {
        return [
            [['u'], 'required'],
        ];
    }


	public static function getCgData($cgnamemd5)
	{
		$result = @Cgdata::find()->where(['cgmd5'=>$cgnamemd5])->one();
		return $result;
	}
	
	public static function getCgDataById($Id)
	{
		$result = @Cgdata::find()->where(['Id'=>$Id])->one();
		return $result;
	}
  
  
	public static function getCgDataByCgmd5($md5)
	{
		$result = @Cgdata::find()->where(['cgmd5'=>$md5])->one();
		return $result;
	}
  
  
	public static function upCgDataThreadNum($cgnamemd5)
	{
		Yii::$app->db->createCommand("lock tables {{%cgdata}} WRITE")->execute();
		$result = Yii::$app->db->createCommand("UPDATE {{%cgdata}} SET cg_thread_num=".new Expression("`cg_thread_num` + 1")." WHERE cgmd5='".$cgnamemd5."'")->execute();
		Yii::$app->db->createCommand("unlock tables")->execute();
		return $result;
	}
	
	public static function downCgDataThreadNum($cgnamemd5)
	{
		Yii::$app->db->createCommand("lock tables {{%cgdata}} WRITE")->execute();
		$result = Yii::$app->db->createCommand("UPDATE {{%cgdata}} SET cg_thread_num=".new Expression("`cg_thread_num` - 1")." WHERE cgmd5='".$cgnamemd5."'")->execute();
		Yii::$app->db->createCommand("unlock tables")->execute();
		return $result;
	}

	public static function upCgDataFollowNum($cgnamemd5)
	{
		Yii::$app->db->createCommand("lock tables {{%cgdata}} WRITE")->execute();
		$result = Yii::$app->db->createCommand("UPDATE {{%cgdata}} SET cg_follow_num=".new Expression("`cg_follow_num` + 1")." WHERE cgmd5='".$cgnamemd5."'")->execute();
		Yii::$app->db->createCommand("unlock tables")->execute();
		return $result;
	}
	
	public static function downCgDataFollowNum($cgnamemd5)
	{
		Yii::$app->db->createCommand("lock tables {{%cgdata}} WRITE")->execute();
		$result = Yii::$app->db->createCommand("UPDATE {{%cgdata}} SET cg_follow_num=".new Expression("`cg_follow_num` - 1")." WHERE cgmd5='".$cgnamemd5."'")->execute();
		Yii::$app->db->createCommand("unlock tables")->execute();
		return $result;
	}
	
}
