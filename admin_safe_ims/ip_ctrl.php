<?php
/***********************************************
 * 禁止提交的IP列表管理页 杨海涛 2014年2月14日 *
 **********************************************/

require_once("./init.php");

//加载访问控制列表类
require_once(MSGROOT."include/acl.class.php");

$acl=new Acl();
	
	//当用户提交数据时候
	if(isset($_POST['denylist'])){
		$denylist=trim($_POST["denylist"]);
		$acl->save_denylist($denylist);
		$accesslog->setlog("更改提交控制列表");
		exit("<script>window.history.go(-1);</script>");
	}

$denylist=$acl->get_denylist();
//初始化模板
$smarty=new Smarty();

//生产环境取消debug
$smarty->debugging=false;


//获取模板所在url并分配
$templateurl=TEMPLATEURL.str_replace(array("\\","."),array(),$smarty->template_dir[0]);

$smarty->assign("templateurl",$templateurl);
$smarty->assign("denylist",$denylist);
$smarty->display("acl.htm");
?>
