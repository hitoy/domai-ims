<?php
/*************************************
 * 系统配置页面 杨海涛 2014年2月14日 *
 ************************************/
require_once("./init.php");

//初始化模板
$smarty=new Smarty();

//生产环境取消debug
$smarty->debugging=false;
//当请求对配置作出更改时

if($_POST){
	if($_SESSION["ulv"]>1) {
		echo "操作失败，权限不足!";
		exit("<script>setTimeout(function(){window.history.go(-1)},1500);</script>");
	};
	$cfg_c=$_POST["cfg"];
	$sysconf->saveconf($cfg_c);
	$accesslog->setlog("更改系统配置->".implode(",",$cfg_c));
	//exit("<script>window.location.reload();</script>");
}

//获取模板所在url并分配
$templateurl=TEMPLATEURL.str_replace(array("\\","."),array("",""),$smarty->template_dir[0]);

//获取系统原有配置信息
$ipctl=$sysconf->ipctl?"开启":"关闭";				//是否开启禁止提交的IP列表功能
$subinterval_cookie=$sysconf->subctl_bycookie;		//是否开启基于cookie判定的提交时间间隔功能
$subinterval_ipaddr=$sysconf->subctl_byip;			//是否开启基于IP地址池中判定连续提交IP的控制的功能
$mulang=$sysconf->Mulang?"开启":"关闭";				//前台提交结果的多语言提示
$cachetime=$sysconf->cachetime;						//前台提交结果的缓存

$smarty->assign("templateurl",$templateurl);
$smarty->assign("ipctl",$ipctl);
$smarty->assign("subinterval_cookie",$subinterval_cookie);
$smarty->assign("subinterval_ipaddr",$subinterval_ipaddr);
$smarty->assign("mulang",$mulang);
$smarty->assign("cachetime",$cachetime);

$smarty->display("sys_setting.htm");
?>
