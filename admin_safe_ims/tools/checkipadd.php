<?php
/*根据IP地址查询归属地，使用淘宝和新浪地址库
 *杨海涛 2017年2月16日
 */
error_reporting(0);
function get_ip_add($ip){
    #淘宝
	$ipfile=file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=".$ip);
    $areaobj = json_decode($ipfile);
    if(!empty($areaobj->data))
        return $areaobj->data->country." ".$areaobj->data->region." ".$areaobj->data->city;
    #新浪
	$ipfile=file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=".$ip);
    $areaobj = json_decode($ipfile);
    if(!empty($areaobj->ret))
        return $areaobj->country." ".$areaobj->province." ".$areaobj->city;
    #聚合
	$ipfile=file_get_contents("http://apis.juhe.cn/ip/ip2addr?ip=".$ip."&key=63a5fa03317127df6fd204272c129636&dtype=json");
    $areaobj = json_decode($ipfile);
    if($areaobj->resultcode == '200')
        return $areaobj->result->area;
    return "查询失败! 请手动查询";
}
$ip=$_GET["ipadd"];
echo get_ip_add($ip);
