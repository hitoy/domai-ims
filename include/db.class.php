<?php
/***************************
数据库类
杨海涛 2013年12月18日
**************************/

//数据库抽象类
abstract class DB{
	//增加或更改数据表记录
	abstract function query();
	//获取数据表一行记录
	abstract function getOne();
	//获取数据表多行记录
	abstract function getRows();
}

class Mysql extends DB{
	private $dbhost;		//主机名
	private $dbuser;		//数据库用户名
	private $dbpassword;	//数据库密码
	private $dbname;		//数据库名
	private $dbprefix;		//数据表前缀
	private $connect;		//数据连接
	private $queryString;	//sql语句

	private  $errorcode=0; //错误码，默认为0，当sql出现错误时，返回7，代表数据库出现问题

	//构造函数，参数一次为，数据库主机，用户名，密码，数据库名称，编码
	public function __construct($host="localhost",$user="root",$password="",$name="msg",$prefix="ims_",$code="utf8"){
		$this->dbhost=$host;
		$this->dbuser=$user;
		$this->dbpassword=$password;
		$this->dbname=$name;
		$this->dbprefix=$prefix;
		$this->dbname=$name;

		//连接数据库
		$this->connect=mysql_connect($host,$user,$password);
		if($this->connect){
			mysql_query("set names $code",$this->connect);
			mysql_select_db($name,$this->connect);
		}else{
			$this->errorcode=7;
		}
	}

	//由于数据表的前缀是用户指定的，而sql语句是事先指定的，需要对前缀进行替换
	public function setQuery($sql){
		$prefix="ims_";
		$this->queryString=str_replace($prefix,$this->dbprefix,$sql);
	}

	//执行不需要结果的sql:insert update
	public function query(){
		mysql_query($this->queryString,$this->connect);
		if(mysql_error()){
			$this->errorcode=7;
		}
	}

	//获取错误代码
	public function get_error(){
		return $this->errorcode;
	}



	/**********************************
	 *以上是前台留言提交必须用到的方法*
	 *以下是后台系统用到的方法*********
	 **********************************/

	//获取一行记录,返回数组
	public function getOne(){
		$re=mysql_query($this->queryString,$this->connect);
		$res=mysql_fetch_row($re);
		if(mysql_error()){
			$this->errorcode=7;
			return;
		}else{
			return $res;
		}
	}

	//获取多行记录，返回二维数组
	public function getRows(){
		$re=mysql_query($this->queryString,$this->connect);
		$res=array();
		while($a=mysql_fetch_assoc($re)){
			$res[]=$a;
		}
		if(empty($res)){
			return;
		}else{
			return $res;
		}
	}

	public function __destruct(){
		if($this->connect){
			mysql_close($this->connect);
		}
	}
}
?>
