<?php
/********************
 * 启动文件 杨海涛***
 * 2014年1月13日*****
 * ******************/

/*
Copyright (C) 2015 杨海涛(vip@hitoy.org)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/


//判断系统是否安装
if(!file_exists("../config.php")){
	exit("您的系统似乎没有安装，请访问 http://".$_SERVER["SERVER_NAME"]."/install/来安装本系统!");
}

//初始化后台路径
define("ADMINROOT",str_replace("\\","/",dirname(__FILE__))."/");
//系统的安装目录
define("MSGROOT",dirname(ADMINROOT)."/");
//网站模板uri
define("TEMPLATEURL",dirname($_SERVER["PHP_SELF"])."/");
//定义session存放目录
session_save_path(ADMINROOT."session");

//判断用户是否登陆
session_start();
if(!isset($_SESSION["uname"])&&basename($_SERVER['PHP_SELF'])!="login.php"){
	header("Location:./login.php");
	exit();
}


//加载系统配置，并实例化
require_once(ADMINROOT."../include/conf.class.php");
$sysconf=Conf::getIns();

//加载数据库类
require_once(ADMINROOT."../include/db.class.php");
$mysql=new Mysql($sysconf->dbhost,$sysconf->dbuser,$sysconf->dbpassword,$sysconf->dbname,$sysconf->prefix,$sysconf->lang);

//加载日志类
require_once(ADMINROOT."/log.class.php");
$accesslog=new Logs();

//加载Smarty模板引擎
require_once(ADMINROOT."libs/Smarty.class.php");
?>
