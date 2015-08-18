<?php
/***
配置类，用来调用配置文件，单例模式
杨海涛，2013年12月18日
***/
class Conf{
	protected static $obj=NULL;
	protected $data;
	protected final function __construct(){
		require(MSGROOT."config.php");
		$this->data=$cfg;
	}
	public static function getIns(){
		if(self::$obj instanceof self){
			return self::$obj;
		}else{
			self::$obj=new self();
			return self::$obj;
		}
	}
	protected final function __clone(){}
		public function __set($k,$v){
			$this->data[$k]=$v;
		}
	public function __get($k){
		if(array_key_exists($k,$this->data)){
			return $this->data[$k];
		}else{
			return NULL;
		}
	}
	//保存配置
	public function saveconf(array $conf){
		$confile=file_get_contents(MSGROOT."config.php");
		foreach($conf as $k=>$v){
			$k=str_replace('\'','"',$k);
			$pattern="/(cfg\[$k\]=)([^;]+);/i";
			$replacement="$1"." ".$v.";";
			$confile=preg_replace($pattern,$replacement,$confile);
		}
		file_put_contents(MSGROOT."config.php",$confile);
	}
}
?>
