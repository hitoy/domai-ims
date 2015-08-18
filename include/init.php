<?php
/***********************************
初始化文件，所有文件均需要调用此文件
*******杨海涛 2013年12月18日********
************************************/
define("MSGROOT",str_replace("\\","/",dirname(dirname(__FILE__)))."/");//网站的根目录
require_once(MSGROOT."include/timer.class.php");
$timer=new Timer();
//加载系统配置类，并实例化
require_once(MSGROOT."include/conf.class.php");
$sysconf=Conf::getIns();
//加载系统提示语言
require_once(MSGROOT."include/language.class.php");
//加载模板类
require_once(MSGROOT."include/template.class.php");
?>
