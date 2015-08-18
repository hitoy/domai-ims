<?php
/***********************************
 * 询盘回收站 杨海涛 2014年2月14日 *
 **********************************/

/*
Copyright (C) 2015 杨海涛(vip@hitoy.org)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

require_once("./init.php");

//获取当前用户等级(是否为管理员)
$ulv=$_SESSION["ulv"];
if($ulv>1) exit("非法访问，权限不足!");

//获取需要进行筛分的参数
$page=isset($_GET["page"])?$_GET["page"]:1;//显示第几页的信息
$pagesize=isset($_COOKIE["listsize"])?$_COOKIE["listsize"]:30;//每页显示的信息数量

//加载信息类
require_once("./msg.class.php");
$spam=new Msg("deled",$pagesize);	//获取删除的信息

//当含有post数据时，表示要求处理信息
if($_POST){
$ids=trim($_POST["id"]);
$action=trim($_POST["action"]);
$id_arr=explode(",",$ids);
foreach($id_arr as $id){
	$spam-> spam_mange($id,$action);
}
exit();
}

//信息列表
$msg_list=$spam->getlist(array("id","name","email","country","product","subtime","team","deal_person"),$page);


$pageinfo=$spam->showpageinfo();

//初始化模板
$smarty=new Smarty();

//生产环境取消debug
$smarty->debugging=false;

//获取模板所在url并分配
$templateurl=TEMPLATEURL.str_replace(array("\\","."),array(),$smarty->template_dir[0]);

$smarty->assign("templateurl",$templateurl);
$smarty->assign("pageinfo",$pageinfo);
$smarty->assign("msg_list",$msg_list);
$smarty->display("recycle.htm");
?>
