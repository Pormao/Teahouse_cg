<?php
namespace app\modules\message\controllers;

use Yii;
use yii\web\Controller;
use yii\caching\FileCache;
use yii\filters\AccessControl;

class MController extends Controller
{	

    public function actionIndex()
    {
        return $this->render('index');
    }
	
}	