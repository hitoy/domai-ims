<?php
/***********************
 * 基于IP的提交控制类
 * 杨海涛 2014年1月2日
 * ********************/

class Acl {
	private $denylist;//禁止访问的IP列表
	//获取访问控制IP列表
	public function __construct(){
		$list=trim(file_get_contents(MSGROOT."safe/acl.deny"));
		$this->denylist=preg_split("/[^\d\.]+/",$list);
	}
	//判断IP是否被禁止
	public function is_forbid($ip){
		if(in_array($ip,$this->denylist)){
			return true;
		}else{
			return false;
		}
	}
	//获取IP列表
	public function get_denylist(){
		$list="";
		foreach ($this->denylist as $ips){
			$list .= $ips."\n";
		}
		return $list;
	}
	//保存IP列表,保存会清空原来文件，请注意操作
	public function save_denylist($iplist){
		$iparr=preg_split("/[^\d\.]+/",trim($iplist));
		$ipfile=fopen(MSGROOT."safe/acl.deny","w");
		foreach ($iparr as $sip){
			fwrite($ipfile,$sip."\n");
		}
		fclose($ipfile);
	}
}
?>
