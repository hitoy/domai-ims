<?php
/***************************************
 * 询盘管理列表页 杨海涛 2014年2月12日 *
 **************************************/
require_once("./init.php");

//获取当前用户等级(是否为管理员)
$ulv=$_SESSION["ulv"];


//获取需要进行筛分的参数
$category=isset($_GET["query"])?$_GET["query"]:"all";//信息分类
$page=isset($_GET["page"])?$_GET["page"]:1;//显示第几页的信息
$pagesize=isset($_COOKIE["listsize"])?$_COOKIE["listsize"]:30;//每页显示的信息数量

//加载信息类
require_once("./msg.class.php");
$msg=new Msg($category,$pagesize);
//信息列表
$list=$msg->getlist(array("id","name","email","country","product","subtime","team","msg_status"),$page);
//对信息列表中消息状态的数字进行转换
foreach($list as $msg_list_single){
	switch (trim($msg_list_single['msg_status'])){
	case 0:
		$msg_list_single['msg_status']="未处理";
		break;
	case 1:
		$msg_list_single['msg_status']="有效";
		break;
	case 2:
		$msg_list_single['msg_status']="重复";
		break;
	case 3:
		$msg_list_single['msg_status']="无效";
		break;
	case 9:
		$msg_list_single['msg_status']="已删除";
		break;
	default:
		$msg_list_single['msg_status']="未处理";
	}
	$msg_list[]=$msg_list_single;
}


$pageinfo=$msg->showpageinfo();


//初始化模板
$smarty=new Smarty();

//生产环境取消debug
$smarty->debugging=false;



//获取模板所在url并分配
$templateurl=TEMPLATEURL.str_replace(array("\\","."),array(),$smarty->template_dir[0]);

$smarty->assign("templateurl",$templateurl);
$smarty->assign("msg_list",$msg_list);
$smarty->assign("pageinfo",$pageinfo);
$smarty->assign("ulv",$ulv);
$smarty->display("msg_list.htm");

?>
