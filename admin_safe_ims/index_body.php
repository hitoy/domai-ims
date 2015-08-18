<?php
require_once("./init.php");

//初始化模板
$smarty=new Smarty();
//生产环境取消debug
$smarty->debugging=false;

//获取模板所在url并分配
$templateurl=TEMPLATEURL.str_replace(array("\\","."),array("",""),$smarty->template_dir[0]);

//获取数据库时间
$mysql->setQuery("select now()");
$now=$mysql->getOne();
$systemtime=$now[0];

$u=$_SESSION["uname"];
//获取用户上次登陆时间
$mysql->setQuery("select lastlogin from ims_user where username=\"$u\"");
$time=$mysql->getOne();
$lastlogintime=$time[0];

//获取登陆次数
$mysql->setQuery("select logcount from ims_user where username=\"$u\"");
$count=$mysql->getOne();
$logincount=$count[0];

//上次登陆IP
$mysql->setQuery("select lastlogip from ims_user where username=\"$u\"");
$addr=$mysql->getOne();
$lastloginaddr=$addr[0];

//本次登陆IP
$loginaddr=$_SERVER["REMOTE_ADDR"];

//昨日总询盘
$mysql->setQuery("select count(id) from ims_message where TO_DAYS(NOW())-TO_DAYS(subtime)=1 and msg_status!=9");
$dayin=$mysql->getOne();
$yesterdayin=$adyin[0];

//今日总询盘
$mysql->setQuery("select count(id) from ims_message where date(subtime)=date(now()) and msg_status!=9");
$today=$mysql->getOne();
$todayin=$today[0];


//未处理询盘
$mysql->setQuery("select count(id) from ims_message where msg_status=0");
$un=$mysql->getOne();
$untreatedin=$un[0];

//总询盘
$mysql->setQuery("select count(id) from ims_message where msg_status!=9");
$all=$mysql->getOne();
$totalin=$all[0];

//服务器系统
preg_match("/\w+\s/",php_uname(),$matches);
$servername=$matches[0];

//服务器IP
$serverip=$_SERVER["SERVER_ADDR"];

//PHP版本
$phpversion=PHP_VERSION;

//web服务器版本
$webserver=$_SERVER["SERVER_SOFTWARE"];


//mysql版本
$mysql->setQuery("select version()");
$version=$mysql->getOne();
$mysqlversion=$version[0];

//客户端cookie支持
$cookiesupport=isset($_COOKIE[session_name()])?"开启":"关闭";


//分配
$smarty->assign("systemtime",$systemtime);
$smarty->assign("lastlogintime",$lastlogintime);
$smarty->assign("logincount",$logincount);
$smarty->assign("lastloginaddr",$lastloginaddr);
$smarty->assign("loginaddr",$loginaddr);


$smarty->assign("yesterdayin",$yesterdayin);
$smarty->assign("todayin",$todayin);
$smarty->assign("untreatedin",$untreatedin);
$smarty->assign("totalin",$totalin);


$smarty->assign("servername",$servername);
$smarty->assign("serverip",$serverip);
$smarty->assign("phpversion",$phpversion);
$smarty->assign("webserver",$webserver);
$smarty->assign("mysqlversion",$mysqlversion);
$smarty->assign("cookiesupport",$cookiesupport);

$smarty->assign("templateurl",$templateurl);
$smarty->display("index_body.htm");
?>
