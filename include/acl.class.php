<?php
/***********************
 * 基于IP的提交控制类
 * 杨海涛 2014年1月2日
 * ********************/
/*
Copyright (C) 2015 杨海涛(vip@hitoy.org)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

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
