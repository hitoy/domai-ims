<?php
/********************
 * 启动文件 杨海涛***
 * 2014年1月13日*****
 * ******************/


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
