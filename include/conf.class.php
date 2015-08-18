<?php
/***
配置类，用来调用配置文件，单例模式
杨海涛，2013年12月18日
***/

/*
Copyright (C) 2015 杨海涛(vip@hitoy.org)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

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
