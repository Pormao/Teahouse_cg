<?php
namespace app\modules\user\controllers;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\UserDataForm;//用户资料表
use yii\web\Response;

/**
 * Portrait controller
 */
ob_end_clean();
 
class PortraitController extends Controller
{
    /**
     * Userhead.
     *
     * @return mixed
     */
    public function actionUserhead($img = false)
    {	
		$response = Yii::$app->getResponse();
		$get = Yii::$app->request->get();
		$userDataModel = new UserDataForm;
		
		if($get['id']){
			if(!$img = $userDataModel->getUserDataById($get['id'])['headpath']){
				$img = 'default.png';
			}
		}else{
			$img = 'default.png';
		}
		
		$imgFullPath = Yii::getAlias('@webroot').'/data/user/avator/'.$img;
	
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
