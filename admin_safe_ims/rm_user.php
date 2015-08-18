<?php
/***********************************
 * 把因为非法退出的用户状态标记为offline*
 * 2014年2月17日********************/
//初始化后台路径
define("ADMINROOT",str_replace("\\","/",dirname(__FILE__))."/");
//系统的安装目录
define("MSGROOT",dirname(ADMINROOT)."/");
//加载系统配置，并实例化
require_once(ADMINROOT."../include/conf.class.php");
$sysconf=Conf::getIns();

//加载数据库类
require_once(ADMINROOT."../include/db.class.php");
$mysql=new Mysql($sysconf->dbhost,$sysconf->dbuser,$sysconf->dbpassword,$sysconf->dbname,$sysconf->prefix,$sysconf->lang);

//加载日志类
require_once(ADMINROOT."/log.class.php");
$accesslog=new Logs();

if($_POST){
	$username=trim(htmlentities($_POST["username"]),ENT_QUOTES);
	$password=sha1(trim(htmlentities($_POST["password"]),ENT_QUOTES));
	$mysql->setQuery("update ims_user set current_stat=\"offline\" where username=\"$username\" and password=\"$password\"");
	$mysql->query();
	@$accesslog->setlog($username."标记自己的状态为离线!");
}
?>
<form action="" method="POST">
<input type="username" name="username"><br/>
<input type="password" name="password"><br/>
<input type="submit" value="SUBMIT"/>
</form>
