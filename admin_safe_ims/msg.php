<?php
/***************************************
 * 询盘管理内容页 杨海涛 2014年1月12日 *
 **************************************/

/*
Copyright (C) 2015 杨海涛(vip@hitoy.org)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

require_once("./init.php");

//获取当前用户等级(是否为管理员)
$ulv=$_SESSION["ulv"];

//加载信息类
require_once("./msg.class.php");
$msg=new Msg();
//信息标记动作
if(isset($_POST["action"])){
	$action=$_POST["action"];
	$id=trim($_POST["id"]);
	$id_arr=explode(",",$id);
	foreach($id_arr as $sid){
		echo $msg->markmsg($action,$sid);
	}
	exit();
}
//获取信息ID
$msgid=isset($_GET["id"])?$_GET["id"]:"";
if($msgid==""||!is_numeric($msgid)) exit("参数非法<script>setTimeout(function(){window.history.go(-1)},3000);</script>");
//根据信息ID获取内容
$msgdetail=$msg->getDetail($msgid);
if(empty($msgdetail)) exit("信息不存在!<script>setTimeout(function(){window.history.go(-1)},3000);</script>");
//初始化模板
$smarty=new Smarty();

//生产环境取消debug
$smarty->debugging=false;

//获取模板所在url并分配
$templateurl=TEMPLATEURL.str_replace(array("\\","."),array(),$smarty->template_dir[0]);

$smarty->assign("templateurl",$templateurl);
$smarty->assign("name",$msgdetail["name"]);
$smarty->assign("subtime",$msgdetail["subtime"]);
$smarty->assign("country",$msgdetail["country"]);
$smarty->assign("url",$msgdetail["url"]);
$smarty->assign("email",$msgdetail["email"]);
$smarty->assign("referer",$msgdetail["http_referer"]);
$smarty->assign("tel",$msgdetail["tel"]);
$smarty->assign("ip",$msgdetail["ip_add"]);
$smarty->assign("product",$msgdetail["product"]);
$smarty->assign("lang",$msgdetail["lang"]);
$smarty->assign("team",$msgdetail["team"]);
$smarty->assign("status",$msgdetail["msg_status"]);
$smarty->assign("message",$msgdetail["message"]);
$smarty->assign("company",$msgdetail["company"]);
$smarty->assign("id",$msgdetail["id"]);
$smarty->assign("deal_person",$msgdetail["deal_person"]);
$smarty->assign("deal_time",$msgdetail["deal_time"]);
$smarty->assign("ulv",$ulv);

$smarty->display("msg.htm");
?>
