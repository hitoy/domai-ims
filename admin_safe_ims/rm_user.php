<?php
/***********************************
 * 把因为非法退出的用户状态标记为offline*
 * 2014年2月17日********************/
/*
Copyright (C) 2015 杨海涛(vip@hitoy.org)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/


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
