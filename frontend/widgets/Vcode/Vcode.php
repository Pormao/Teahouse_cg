<?php
   namespace app\widgets\Vcode;
   use yii\base\Widget;
   class Vcode extends Widget {
      public function init() {
         parent::init();
         ob_start();
      }
	  public $vcodePath;
      public function run() {
         $content = ob_get_clean();
		 return $this->render('vcode',['vcodePath' => $this->vcodePath,'vcodeImg' => $content]);
      }
   }
?> 