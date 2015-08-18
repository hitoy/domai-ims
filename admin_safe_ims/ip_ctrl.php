<?php
/***********************************************
 * 禁止提交的IP列表管理页 杨海涛 2014年2月14日 *
 **********************************************/

/*
Copyright (C) 2015 杨海涛(vip@hitoy.org)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

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
