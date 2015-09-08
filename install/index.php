<?php
/**********************************
 * 系统安装文件
 * 杨海涛 2014年1月8日
 * *******************************/
error_reporting(E_ALL);
header("Content-Type:text/html;charset=utf-8");
if(file_exists("./install.lock")){
	echo "系统已经安装，如需重新安装系统，请删除install目录下的install.lock文件";
	exit();
}
define("MSGROOT",str_replace("\\","/",dirname(dirname(__FILE__)))."/");
//获取目录是否可读写的问题
function getmod($dir){
	$dir=MSGROOT.$dir;
	$r=is_readable($dir)?"可读":"<strong style='color:red'>不可读</strong>";
	$w=is_writeable($dir)?"可写":"<strong style='color:red'>不可写</strong>";
	return $r."+".$w;
}	

//加载安装类，并实例化
require_once("./install.class.php");

$installer=new Install();

echo $installer->showstep();
?>
