<?php
namespace app\modules\user\controllers;

use app\models\UserDataForm;//用户资料表
use Yii;
use yii\web\Controller;

use yii\filters\AccessControl;

class ProfileController extends Controller
{	
	
	public function actionIndex()
    {
        $get = Yii::$app->request->get();
        $userDataModel = new UserDataForm;
        $userData = $userDataModel->getUserDataById($get['u']);
        return $this->render('index',['userData' => $userData]);
    }
	
}	