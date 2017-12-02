<?php
namespace common\helpers;

/*
 * 自定义全局公共方法
 */
class commonFunctionApis{

	public static function createGuid()
	{  
    $charid = strtoupper(md5(uniqid(mt_rand(), true)));  
    $hyphen = chr(45);// "-"  
    $uuid = chr(123)// "{"  
    .substr($charid, 0, 8).$hyphen  
    .substr($charid, 8, 4).$hyphen  
    .substr($charid,12, 4).$hyphen  
    .substr($charid,16, 4).$hyphen  
    .substr($charid,20,12)  
    .chr(125);// "}"  
    return $uuid;  
	} 
	
	
}
