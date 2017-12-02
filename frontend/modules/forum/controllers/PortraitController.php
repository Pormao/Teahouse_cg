<?php
namespace app\modules\forum\controllers;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\CgDataForm;//茶馆资料表
use yii\web\Response;

/**
 * Portrait controller
 */
ob_end_clean();
 
class PortraitController extends Controller
{
    /**
     * Cghead.
     *
     * @return mixed
     */
    public function actionCghead($img = false)
    {	
		$response = Yii::$app->getResponse();
		$get = Yii::$app->request->get();
		$userDataModel = new CgDataForm;
		
		if($get['md5']){
			if(!$img = $userDataModel->getCgDataByCgmd5($get['md5'])['cg_headpath']){
				$img = 'default.png';
			}
		}else{
			$img = 'default.png';
		}
		
		$imgFullPath = Yii::getAlias('@webroot').'/data/cg/avator/'.$img;
	
        if (!$img || !file_exists($imgFullPath))
            throw new NotFoundHttpException('requested page not exists.');

        $response = Yii::$app->getResponse();
        $response->headers->set('Content-Type', 'image/jpeg');
        $response->format = Response::FORMAT_RAW;
        if ( !is_resource($response->stream = fopen($imgFullPath, 'r')) )
            throw new \yii\web\ServerErrorHttpException('file access failed: permission deny');
        return $response->send();
		
		
    }
	
}
