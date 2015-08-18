<?php
/*根据IP地址查询归属地，使用IP138地址库
 *杨海涛 2013年12月4日
 */
function get_ip_add($ip){
	$ip_rep="/\d+\.\d+\.\d+\.\d+/";
	if(!preg_match($ip_rep,$ip)){exit("查询失败,输入IP非法!");}
	$ipfile=file_get_contents("http://www.ip138.com/ips138.asp?ip=".$ip);
	$ipfile=iconv("gb2312","utf-8",$ipfile);
	$file_rep="/<ul\sclass=\"ul1\"><li>[^<\/]+/";
	preg_match($file_rep,$ipfile,$resulte);
	if(preg_match("/\：[\s\S]+/",$resulte[0],$ipadd)){
		return $ipadd[0];
	}else{
		return "查询失败，请手动查询!";
	}
}
$ip=$_GET["ipadd"];
echo get_ip_add($ip);
?>
