<?php
namespace app\modules\forum\models;

use Yii;
use yii\base\Model;
use common\models\Cgdata;
use yii\db\Query;
use yii\db\Command;
use yii\db\Expression;

class CgCreateForm extends Model
{

    public function rules()
    {
		
    }

	public static function createCg($cgname,$cgdescr,$cg_type,$cg_createuid,$cg_createtime,$cgmd5)
	{
		return Yii::$app->db
			->createCommand()->insert('{{%cgdata}}', [
			'cgname' => $cgname,
			'cgdescr' => $cgdescr,
			'cgtype' => $cg_type,
			'cg_createuid' => $cg_createuid,
			'cg_createtime' => $cg_createtime,
			'cgmd5' => $cgmd5
			])->execute();

	}

}
