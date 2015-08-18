<?php
/****************************************
 * 用户管理 列表页 杨海涛 2014年2月13日 *
 ***************************************/

require_once("./init.php");

//加载用户类
require_once("./user.class.php");
$uclass=new User();

//初始化模板
$smarty=new Smarty();
//生产环境取消debug
$smarty->debugging=false;

//获取用户列表
$userlist=$uclass->showuserlist();

//获取模板所在url并分配
$templateurl=TEMPLATEURL.str_replace(array("\\","."),array(),$smarty->template_dir[0]);

$smarty->assign("templateurl",$templateurl);
$smarty->assign("userlist",$userlist);

$smarty->display("user_list.htm");
?>
