<?php
/*************************************
 * 系统日志管理 杨海涛 2014年2月14日 *
 ************************************/
require_once("./init.php");

//获取系统含有的日志列表
$loglist=$accesslog->getloglist();
//如果用户提交数据
	if($_POST){
		$file=trim($_POST['date']);
		$action=trim($_POST['action']);
		if($action=="cat"){
			$accesslog->readlog($file);
			exit();
		}else{
			echo $accesslog->removelog($file);
			exit("<script>setTimeout(function(){window.history.go(-1)},1500);</script>");
		}
		exit();
	}
//初始化模板
$smarty=new Smarty();

//生产环境取消debug
$smarty->debugging=false;


//获取模板所在url并分配
$templateurl=TEMPLATEURL.str_replace(array("\\","."),array(),$smarty->template_dir[0]);

$smarty->assign("templateurl",$templateurl);
$smarty->assign("loglist",$loglist);
$smarty->display("log_manage.htm");
?>
