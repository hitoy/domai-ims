<?php
/*******************************
 * 语言类，用来显示系统提示语言*
 * 杨海涛，2013年12月23日
 * ****************************/
/*
Copyright (C) 2015 杨海涛(vip@hitoy.org)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

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
