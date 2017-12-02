<?php

namespace app\models;

use Yii;
use yii\base\Model;
use common\models\User;
use yii\db\Query;
use yii\db\Command;
use yii\db\Expression;

class UserDataForm extends Model
{
	
    public static function getUserDataById($Id)
    {
        return ($rows = (new Query())
			->select(['id','username','email','headpath'])
			->from('{{%user}}')
			->where(['id' => $Id])
			->limit(1)
			->one()
		);
    }
	
	public static function updataHeadById($Id,$head_filename)
    {
		$result = Yii::$app->db->createCommand("UPDATE {{%user}} SET headpath='".$head_filename."' WHERE id='".$Id."'")->execute();
		return $result;
	}
}
