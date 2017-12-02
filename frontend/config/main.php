<?php
date_default_timezone_set('PRC'); //设置中国时区

$template_name = constant("TEMPLATENAME");
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
     
    'modules' => [
         'forum' => [
            'class' => 'app\modules\forum\forumModule', 
         ],
		 
		 'user' => [
            'class' => 'app\modules\user\userModule', 
         ],
		 
		 'search' => [
            'class' => 'app\modules\search\searchModule', 
         ],
		 
		 'message' => [
            'class' => 'app\modules\message\messageModule', 
         ],
    ],
	
    
    'components' => [
    
    'view' => [
            'theme' => [
                'basePath' => '@app/themes/basic',
                'baseUrl' => '@web/themes/basic',
                'pathMap' => [
                    '@app/views' => '@app/themes/'.$template_name.'/modules',
					'@app/modules' => '@app/themes/'.$template_name.'/modules' 
                ],
            ],
        ],
    
    
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
		
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            //'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
		
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
		
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
		
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'i18n' => [
            'translations' => [
                'common' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '/messages',
                    'fileMap' => [
                        'common' => 'common.php',
                    ],
                ],
                'power' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '/messages',
                    'fileMap' => [
                        'power' => 'power.php',
                    ],
                ],
            ],
        ],
      

		'assetManager' => [
				'bundles' => [ 
				'yii\bootstrap\BootstrapAsset' => [
				'css' => [],  // 去除 bootstrap.css
				'sourcePath' => null, // 防止在 frontend/web/asset 下生产文件
				],
				'yii\bootstrap\BootstrapPluginAsset' => [
					'js' => [],  // 去除 bootstrap.js
					'sourcePath' => null,  // 防止在 frontend/web/asset 下生产文件
				],
			],

		],

		'urlManager'=>array(  
             'enablePrettyUrl' => true, //对url进行美化 
             'showScriptName' => false,//隐藏index.php   
             //'suffix' => '.html',//后缀
             'enableStrictParsing' => false,//不要求网址严格匹配，则不需要输入rules
             'rules' => [
				'/' => '/site/index',
				
				'/p/<t:\d+>/' => '/forum/m/p',
				'/u/<u:\w+>/' => '/forum/m/u',
				'/u/settings/<cgnamemd5:\w+>/' => '/forum/settings',
				'/createcg' => '/forum/createcg/index',
				'/msgs' => '/message/m/index',

				'/cg/h' => '/forum/portrait/cghead',
				
				'/<u:\w+>/profile/' => '/user/profile',
				'/user/h' => '/user/portrait/userhead',
				
				'/search' => '/search/searchviews',

			 ]//网址匹配规则
			 ), 
		
		
		
		/*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,

'language'=>'zh-CN',



];
