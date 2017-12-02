<?php
namespace common\helpers;

/*
 * 自定义全局公共方法
 */
class levelApis{
	
	public static function calLevel($exp){
		 $level = ceil(($exp/1.5201314/100)-2);
		 if($level<1){$level = 1;}
		 return $level;
	  }
	  
	public static function calLevelExp($level){
		  $exp = floor(($level+2)*100*1.5201314);
		  return $exp;
	  }
	  
}
