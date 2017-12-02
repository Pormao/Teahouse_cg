<?php
namespace app\modules\search\controllers;

use frontend\models\SearchForm;
use Yii;
use yii\web\Controller;
use yii\caching\FileCache;
use yii\filters\AccessControl;

class SearchviewsController extends Controller
{	
	
	/**
     * Search.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        
        $get = Yii::$app->request->get();
        
        $SearchModel = new SearchForm;
        $FileCache = new FileCache;
        $FileCache->flush();
        $searchList = $FileCache->get('SearchListCache-'.$get['wd']);
		     
         	if ($searchList === false) {
		        		$searchList = $SearchModel->SearchThreadList($get['wd'],10);
		        		$FileCache->set('SearchListCache-'.$get['wd'],$searchList,60*5); //缓存5分钟
			    } 
        
    
        return $this->render('index',['searchList' => $searchList]);
    }
	
}	