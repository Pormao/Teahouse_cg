<?php
   namespace app\widgets\SearchList;
   use yii\base\Widget;
   use Yii;
   
   class SearchList extends Widget {
	  public $searchList;
	  
      public function run() {
         return $this->render('searchList',['searchList' => $this->searchList]);
      }
   }
?> 