<?php
/************************************
 * 系统登陆首页 杨海涛 2014年2月11日*
 ************************************/

require_once("./init.php");

//初始化模板
$smarty=new Smarty();
//生产环境取消debug
$smarty->debugging=false;

//获取模板所在url并分配
$templateurl=TEMPLATEURL.str_replace(array("\\","."),array("",""),$smarty->template_dir[0]);
$smarty->assign("templateurl",$templateurl);
//获取当前用户名并分配
$current_user=$_SESSION["uname"];
$smarty->assign("user",$current_user);

$smarty->display("index.htm");
?>
