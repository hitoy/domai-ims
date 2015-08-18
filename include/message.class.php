<?php
/*************************************
 *留言信息类，作为被观察者
 2013年12月20日
 **************************************/

class Msg{
	private $name;			//客户姓名
	private $email;			//邮箱
	private $message;		//信息
	private $tel;			//电话
	private $company;		//公司名
	private $product;		//需求产品
	private $country;		//国家
	private $url;			//来源url
	private $lang;			//语言
	private $team;			//信息分组
	private $ip_add;		//信息提交IP
	private $http_referer;	//基于HTTP协议的来源判断
	private $user_agent;	//提交信息设备

	private $other_data=array();	//扩展信息

	//构造
	public function __construct($team,$ip_add,$http_referer,$user_agent){
		$this->team=self::dprocess($team);
		$this->ip_add=self::dprocess($ip_add);
		$this->http_referer=self::dprocess($http_referer);
		$this->user_agent=self::dprocess($user_agent);
	}


	//传入其它数据
	public function setmaindata($arr){
		foreach ($arr as $key=>$value){
			$this->$key=self::dprocess($value);
		}
	}

	//表单的数据处理，数组拼接，防XSS等
	private static function dprocess($d){
		if(gettype($d)=="array"){
			//当表单提交的是数组时候
			$td="";
			foreach ($d as $k){
				$td .=trim(htmlentities($k,ENT_QUOTES)).",";
			}
			return rtrim($td,",");
		}else if(gettype($d)=="string"){
			//当表单提交是字符串时候
			return trim(htmlentities($d,ENT_QUOTES,"utf-8"));
		}
	}
	//检查必须项是否合法
	private function error_check(){
		$emailexp="/[^\s\n]+\@[^\s\n]+\.(\w{2,4})$/i";
		if($this->name==""){
			//用户名为空，返回错误4
			return 4;
		}else if(!preg_match($emailexp,$this->email)){
			//邮箱不合法或者为空，返回五
			return 5;
		}else if($this->message==""){
			//主要信息为空，返回6
			return 6;
		}else{
			//其它情况下，返回错误码0
			return 0;
		}
	}
	//魔法函数:其它信息的处理
	public function __set($k,$v){
		$this->other_data[$k]=$v;
	}
	public function __get($k){
		if($k=="errorcode"){
			return $this->errorcode;
		}else if(isset($this->other_data[$k])){
			return $this->other_data[$k];
		}else{
			return NULL;
		}
	}
	//获取两次提交信息的时间间隔 基于cookie
	public function getsubinterval(){
		@$cookie_subinterval=$_COOKIE["__last_sub_time"];
		if(isset($cookie_subinterval)){
			setcookie("__last_sub_time",time(),time()+2592000,"/");
			return time()-$cookie_subinterval;
		}else{
			setcookie("__last_sub_time",time(),time()+2592000,"/");
			return 2592000;
		}
	}
	//获取相同IP提交的次数
	public function getsubcount(){
		$ip_pool=file_get_contents(MSGROOT."safe/dynamic_ip_pool");
		$ip_arr=explode("\n",$ip_pool);
		$count=array_count_values($ip_arr);
		return $count[$this->ip_add]?$count[$this->ip_add]:0;
	}
	//获取sql语言
	public function getsql(){
		if($this->error_check()>0){
			return $this->error_check();
		}else{
			//获取other_data中数据
			$field_k="";
			$field_v="";
			if(count($this->other_data)>0){
				foreach ($this->other_data as $k=>$v){
					$field_k .=",$k";
					$field_v .=",$v";
				}
			}
			return "insert into ims_message (name,email,message,tel,company,product,country,url,lang,team,subtime,ip_add,http_referer,user_agent $field_k) values ('$this->name','$this->email','$this->message','$this->tel','$this->company','$this->product','$this->country','$this->url','$this->lang','$this->team',now(),'$this->ip_add','$this->http_referer','$this->user_agent' $field_v)";
		}
	}
	//对象被析构时，把IP存入IP池
	public function __destruct(){
		$ip_pool=trim(file_get_contents(MSGROOT."safe/dynamic_ip_pool"));
		$ip_arr=explode("\n",$ip_pool);
		array_unshift($ip_arr,$this->ip_add);
		while(count($ip_arr)>200){
			array_pop($ip_arr);
		}
		//开始更新IP表
		$sub_iptables=fopen(MSGROOT."safe/dynamic_ip_pool","w");
		do {
			usleep(88);
		}while(!flock($sub_iptables,LOCK_EX));
		foreach($ip_arr as $singleip){
			fwrite($sub_iptables,trim($singleip)."\n");
		}
		flock($sub_iptables,LOCK_UN);
		fclose($sub_iptables);
	}
}
?>
