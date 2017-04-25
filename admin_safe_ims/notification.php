<?php
/*
 * 新留言桌面通知
 * 杨海涛 2017年4月17日
 */
header("Content-Type:text/application");
require_once("./init.php");
$ignore=isset($_GET['ignore'])?trim($_GET['ignore'],","):'0';
$mysql->setQuery("select * from ims_message where id > $ignore and msg_status = 0");
$list = $mysql->getRows();
echo json_encode($list);

