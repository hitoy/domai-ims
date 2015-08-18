<?php
/************************************
 * 用户登陆页面 杨海涛 2014年1月13日*
 * *********************************/

//初始化
require_once("./init.php");

//加入登陆类
require_once(ADMINROOT."login.class.php");

//初始化模板引擎
$smarty=new Smarty();

//生产环境取消debug
$smarty->debugging=false;

//获取模板所在url并分配
$templateurl=TEMPLATEURL.str_replace(array("\\","."),array("",""),$smarty->template_dir[0]);
$smarty->assign("templateurl",$templateurl);

//用户请求登陆的情况
if($_POST){
	$cuser=new User();
	$username=trim($_POST['username']);
	$password=trim($_POST['password']);
	if($cuser->checkUser($username,$password)){
		$cuser->keepUser();
		header("Location:./");
	}else{
		$errormsg=$cuser->logerrormsg;
		$smarty->assign("errormsg",$errormsg);
		$smarty->display("login.htm");
	}
}else{
	//设置错误提示默认为空并分配
	$errormsg="";
	$smarty->assign("errormsg",$errormsg);
	$smarty->display("login.htm");
}
?>
