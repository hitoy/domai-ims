<?php
/************************************
 * 用户登陆页面 杨海涛 2014年1月13日*
 * *********************************/

/*
Copyright (C) 2015 杨海涛(vip@hitoy.org)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

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
