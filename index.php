<?php
/********************************
 * 首页文件，杨海涛 2014年1月8日*
 *** 判定系统是否安装与防扫描***
 *******************************/
if(!file_exists("./config.php")){
	header("Location:./install/");
	exit();
}else{
	header("HTTP/1.1 404 Not Found");
}
?>
