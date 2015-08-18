<?php
/************************
 * 后台用户在线检测 *
 * 此脚本用来监测用户在线状态，当用户超过给定时间不活动时，自动踢出用户
 *************************/

/*
Copyright (C) 2015 杨海涛(vip@hitoy.org)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

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
