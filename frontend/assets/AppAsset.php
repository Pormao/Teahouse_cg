<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
 $template = constant("TEMPLATENAME");
class AppAsset extends AssetBundle
{
	//public $basePath = '@webroot';
    //public $baseUrl = '@web';
	
	public function init()
	{
		$this->sourcePath = '@webroot/../themes/'.constant("TEMPLATENAME");
	}
	
    public $css = [
        'css/style.css',
		'css/navbar.css',
    ];
    public $js = [
		'js/jquery/jquery-1.8.3.js',
		'js/cg.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
       // 'yii\bootstrap\BootstrapAsset',
    ];   

}

