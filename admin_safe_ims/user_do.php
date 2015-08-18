<?php
/*************************************
 * 用户管理页面 杨海涛 2014年2月13日 *
 ************************************/
require_once("./init.php");

if(!$_GET) exit("非法操作!");

//加载用户类
require_once("./user.class.php");
$uclass=new User();

//初始化模板
$smarty=new Smarty();

//生产环境取消debug
$smarty->debugging=false;

//获取模板所在url并分配
$templateurl=TEMPLATEURL.str_replace(array("\\","."),array(),$smarty->template_dir[0]);

$smarty->assign("templateurl",$templateurl);

//获取管理的动作
$action=$_GET["action"];
@$uid=$_GET["id"];

if($action=="del"){
	//当要求删除对应用户时:
	echo $uclass->deluser($uid);
	exit("<script>window.setTimeout(function(){window.history.go(-1);},2000);</script>");
}else if($action=="change"){
	//当要求为更改用户密码时
	if(!$_POST){
		$tgusername=$uclass->getusername($uid);
		$smarty->assign("username",$tgusername);
		$smarty->display("user_mod.htm");
	}else{
		$password=$_POST["password"];
		$passwordag=$_POST["password_ag"];
		echo $uclass->changepasswd($uid,$password,$passwordag);
		exit("<script>window.setTimeout(function(){window.location.href='./user_list.php';},1500);</script>");
	}

}else if($action=="add"){
	//当用户需要添加用户时
	if(!$_POST){
		$smarty->display("user_add.htm");
	}else{
		$username=trim($_POST["uname"]);
		$nickname=trim($_POST["realname"]);
		$userleve=trim($_POST["ulv"]);
		$password=trim($_POST["password"]);
		echo $uclass->adduser($username,$password,$userleve,$nickname);
		exit("<script>window.setTimeout(function(){window.location.href='./user_list.php';},1500);</script>");
	}
}else{
	exit("非法操作!");
}
?>
