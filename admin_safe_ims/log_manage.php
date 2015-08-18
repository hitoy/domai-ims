<?php
/*************************************
 * 系统日志管理 杨海涛 2014年2月14日 *
 ************************************/

/*
Copyright (C) 2015 杨海涛(vip@hitoy.org)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

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
