<?php
namespace common\helpers;

/*
 * 自定义全局公共方法
 */
class postApis{
	
	public static function cutArticle($data,$cut=0,$str="...")  //取文章摘要
	{     
		$data=strip_tags($data);
		$pattern = "/&[a-zA-Z]+;/";
		$data=preg_replace($pattern,'',$data);  
		if(!is_numeric($cut))  
		return $data;  
		if($cut>0)  
		$data=mb_strimwidth($data,0,$cut,$str);  
		return $data;  
	}
	
	public static function dm_strimwidth($str ,$start , $width ,$trimmarker ){ //截断方法
		$output = preg_replace('/^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$start.'}((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$width.'}).*/s','\1',$str);
		return $output.$trimmarker;
	}
	
	public static function getpic($str){
		$pattern="/<[img|IMG].*?class=[\"td_pic\"].*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/"; 
		preg_match_all($pattern,$str,$match); 
		return @$match[1]; 
	}
}
