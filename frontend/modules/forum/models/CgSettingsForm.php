<?php
namespace app\modules\forum\models;

use Yii;
use yii\base\Model;
use common\models\Cgdata;
use yii\db\Query;
use yii\db\Command;
use yii\db\Expression;

class CgSettingsForm extends Model
{

    public function rules()
    {
		
    }

	public static function setCgDataByCgnamemd5($cg_descr,$cg_type,$cgmd5)
	{
		$result = Yii::$app->db->createCommand()->
		update('{{%cgdata}}', [
			'cgdescr' => $cg_descr,
			'cgtype' => $cg_type
		], 
		['cgmd5' => $cgmd5])->execute();
		return $result;
	}

}
