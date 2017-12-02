<?php
   namespace app\widgets\TopicList;
   use yii\base\Widget;
   use Yii;
   
   class TopicList extends Widget {
	  public $cgThreadsList;
	  public function run() {
		 return $this->render('topicList',['cgThreadsList' => $this->cgThreadsList]);
      }
	  
   }
?> 