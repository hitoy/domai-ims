<?php
/**********************************
 * 用户类 杨海涛 2014年1月13日*
 * *******************************/
class User {
	private $username;
	private $password;
	private $userleve;
	public $logerrormsg;//登陆失败的原因
	public function __construct(){
		$this->autologin=isset($_POST["autologin"])?$_POST["autologin"]:"off";	
	}

	//登陆
	public function checkUser($u,$p){
		global $mysql;//实例化的mysql对象
		$p=sha1($p);
		$sql="select current_stat,userleve from ims_user where username=\"$u\" and password=\"$p\"";
		$mysql->setQuery($sql);
		if(!$result=$mysql->getOne()){
			$this->logerrormsg="用户名或密码错误!";
			return false;
		}else if($result[0]=='online'){
			$this->logerrormsg="当前用户已经登陆!";
			return false;
		}else if($result[0]=='offline'){
			$this->username=$u;
			$this->password=$p;
			$this->userleve=$result[1];
			return true;
		}
	}
	//保存当前用户
	public function keepUser(){
		global $mysql;
		$_SESSION["uname"]=$this->username;
		$_SESSION["ulv"]=$this->userleve;
		//更新当前用户在线状态
		$sql="update ims_user set current_stat=\"online\" where username=\"$this->username\"";
		$mysql->setQuery($sql);
		$mysql->query();
		//获取登陆时间并保存为session以便系统退出时保存上次登陆时间
		$mysql->setQuery("select now()");
        $lastlogintime=$mysql->getOne();
		$_SESSION["lastlogtime"]=$lastlogintime[0];
		//写入访问日志
		global $accesslog;
		$accesslog->setlog("登陆系统!");
	}

	//退出
	public function logout(){
		//写入访问日志
		global $accesslog;
		$accesslog->setlog("退出系统!");
		//销毁session并更新用户状态
		$u=$_SESSION["uname"];
		session_destroy();
		//更新用户状态为未登录
		global $mysql;
			$ip=$_SERVER['REMOTE_ADDR'];//本次登陆ip
			$lastlogtime=$_SESSION["lastlogtime"];//获取本次登陆时间
			//获取登陆次数
			$mysql->setQuery("select logcount from ims_user where username=\"$u\"");
            $log=$mysql->getOne();
			$logcount=$log+1;
		$sql="update ims_user set current_stat=\"offline\",lastlogip=\"$ip\",logcount=\"$logcount\",lastlogin=\"$lastlogtime\" where username=\"$u\"";
		$mysql->setQuery($sql);
		$mysql->query();
	}
}
?>
