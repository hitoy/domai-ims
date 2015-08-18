<?php
//获取最新版本信息
$host=@$_SERVER["HTTP_HOST"];
echo @file_get_contents("http://lab.hitoy.org/msg/latestvertion.php?host=$host");
?>
