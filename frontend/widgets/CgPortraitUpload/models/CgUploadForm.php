<?php
namespace app\widgets\CgPortraitUpload\models;

use Yii;
use yii\base\Model;
use yii\db\Command;

/**
 * UploadForm is the model behind the upload form.
 */
class CgUploadForm extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $file;

    /**
     * @return array the validation rules.
     */
		public function rules()
		{
			 return [
						[['file'], 'file','extensions' => 'jpg,png','maxSize'=>1024000,'checkExtensionByMimeType'=>false],
					];
		}
		
		
	public static function updataHeadByCgmd5($cgnamemd5,$head_filename)
    {
		$result = Yii::$app->db->createCommand("UPDATE {{%cgdata}} SET cg_headpath='".$head_filename."' WHERE cgmd5='".$cgnamemd5."'")->execute();
		return $result;
	}
	
}