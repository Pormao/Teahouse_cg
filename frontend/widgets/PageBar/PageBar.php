<?php 
   namespace app\widgets\PageBar; 
   use yii\base\Widget; 
   class PageBar extends Widget { 
	public $page;
	public $pageNum; 
	public $dataCount;
	  
      public function run() { 
		if(!$this->page){$page = 1;}else{$page = $this->page;}
		$allPageNum = ceil($this->dataCount/$this->pageNum);
		$ph = floor(($page+10)/10)*10-10+1;
		
		if($page > 1){$pageList = '<a href="?pg='.($page-1).'">上一页</a>';}
		for ($p=$ph-2; $p<=$ph+9; $p++) {
			if ($p > $allPageNum){break;}
			if ($p == $page){$style = ' class="page"';}else{$style = '';}
			if ($p >= 1){$pageList = @$pageList.'<a'.@$style.' href="?pg='.$p.'">'.$p.'</a>';}
		} 
		if($allPageNum > $page){$pageList = $pageList.'<a href="?pg='.($page+1).'">下一页</a>';}
	  
		 return $this->render('pageBar',['pageList' => @$pageList, 'page' => $page, 'allPageNum' => $allPageNum]);
      } 
   } 
?>