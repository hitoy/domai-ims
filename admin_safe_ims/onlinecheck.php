<?php
/************************
 * 后台用户在线检测 *
 * 此脚本用来监测用户在线状态，当用户超过给定时间不活动时，自动踢出用户
 *************************/
require_once("./init.php");
//加载登陆类,并实例化
require_once(ADMINROOT."login.class.php");
$user=new User();

//获取已经登陆系统的用户
$mysql->setQuery("select username from ims_user where current_stat=\"online\"");
$onlinelist=array();
foreach ($mysql->getRows() as $v){
$onlinelist[]=$v['username'];
};
//获取脚本最大执行时间
$maxexetime=function_exists("init_get")?ini_get("max_execution_time"):"80";
$maxexetime=$maxexetime>65?60:$maxexetime-5;



?>
