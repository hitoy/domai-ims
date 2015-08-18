<?php
/*******************************
 * 语言类，用来显示系统提示语言*
 * 杨海涛，2013年12月23日
 * ****************************/
interface Lang{
	//获取系统支持的语言
	function getsupportlanguage();
	//提示用户信息提交的成败或其它信息,参数为执行成败的code
	function prompt($code);
}

class Language implements Lang{
	private $lang;
	public $notice=array();
	public function __construct($lang){
		if(!in_array($lang,$this->getsupportlanguage())){
			$this->lang="en";
		}else{
			$this->lang=$lang;	
		}
	}
	public function getsupportlanguage(){
		$alllang=opendir(MSGROOT."/include/lang/");
		while($sfile=readdir($alllang)){
			if($sfile=="."||$sfile=="..") continue;
			$langarr[]=trim(substr($sfile,0,-4));
		}
		closedir($alllang);
		return $langarr;
	}
	public function prompt($code){
		require_once(MSGROOT."include/lang/".$this->lang.".php");
		$this->notice=$notice[$code];
	}
}
?>
