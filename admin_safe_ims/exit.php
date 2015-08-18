<?php
/*用户退出
 * 2014年1月16日
 */
require_once("./init.php");
require_once(ADMINROOT."login.class.php");
$user=new User();
$user->logout();
header("Location:./login.php");
?>
