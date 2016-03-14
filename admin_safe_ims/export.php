<?php
/*************************************
 * 系统配置页面 杨海涛 2016年3月14日 *
 ************************************/
/*
Copyright (C) 2015 杨海涛(vip@hitoy.org)
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/
require_once("./init.php");
//初始化模板
$smarty=new Smarty();
//生产环境取消debug
$smarty->debugging=false;

function strip($str){
return preg_replace("/[,\r\n]/"," ",$str);
}

//当请求对配置作出更改时
if($_POST){
	if($_SESSION["ulv"]>1) {
		echo "操作失败，权限不足!";
		exit("<script>setTimeout(function(){window.history.go(-1)},1500);</script>");
	};
	$start_time=strtotime($_POST["stime"]);
	$end_time=strtotime($_POST["etime"]." 23:59:59");
	$mysql->setQuery("select id,name,email,tel,company,product,country,url,team,subtime,deal_time,ip_add,message from ims_message where msg_status=3 and unix_timestamp(subtime) >= $start_time and unix_timestamp(subtime) <= $end_time");
	$rows = $mysql->getRows();
	header('Content-Encoding: UTF-8');
	header('Content-type:text/csv; charset=UTF-8');
	header('Content-Disposition:attachment; filename='.$start_time.'-'.$end_time.'.csv');
	echo "\xEF\xBB\xBF";
	echo "id,"."姓名,"."邮箱,"."电话,"."公司,"."产品,"."国家,"."网站,"."分组,"."提交时间,"."处理时间,"."IP地址,"."信息内容\n";
	foreach($rows as $row){
		$row = array_map("trim",$row);
		$row = array_map("strip",$row);
		echo $row['id'].",".$row['name'].",".$row['email'].",".$row['tel'].",".$row['company'].",".$row['product'].",".$row['country'].",".$row['url'].",".$row['team'].",".$row['subtime'].",".$row['deal_time'].",".$row['ip_add'].",".$row['message']."\n";
	}
	$accesslog->setlog("导出无效信息-> $start_time - $endtime");
	exit();
}

//获取模板所在url并分配
$templateurl=TEMPLATEURL.str_replace(array("\\","."),array(),$smarty->template_dir[0]);
$smarty->assign("templateurl",$templateurl);
$smarty->display("export.htm");
