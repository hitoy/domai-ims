<?php
/****************************
 * 模板展示类 2014年1月2日
 * 杨海涛
 ****************************/

/*
Copyright (C) 2015 杨海涛(vip@hitoy.org)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/


class Template{
	private $temp_dir;
	private $comp_dir;
	private $tpl_vars=array();

	//打开模板内容
	public function __construct($temp_dir="hito"){
		$this->temp_dir=MSGROOT."templates/".trim($temp_dir,"/")."/";
		$this->comp_dir=MSGROOT."templates/templates_compile/";
	}
	//分配
	public function assign($k,$v=NULL){
		if(!$k==""){
			$this->tpl_vars[$k]=$v;
		}
	}
	/*进行标签替换
	 * 需要替换的标签:lang,title,body,exetime,include等
	 */
	private function replace_tag($str){
		$reg=array(
			'/\{msg\:([^\s\n\r\}]*)\}/i',
			'/\{include\:([^\s\n\r\}]*)\}/i'
		);
		$replace=array(
			'<?php echo $this->$1; ?>',
			'<?php include $1; ?>'
		);
		return preg_replace($reg,$replace,$str);
	}

	public function __get($k){
		return $this->tpl_vars[$k];
	}
	public function display(){
		$tpl_file=$this->temp_dir."message_do.html";				//原模板文件
		$compiled_file=$this->comp_dir."message_do.php";		//编译之后的文件
		if(!file_exists($tpl_file)){
			return false;
		}
		//如果编译文件不存在或者模板被更改，则重新生成编译文件，否则使用原来的文件
		if(!file_exists($compiled_file) || filemtime($tpl_file)>filemtime($compiled_file)){
			$tpl_file_content=file_get_contents($tpl_file);
			$compile_file_content=$this->replace_tag($tpl_file_content);
			file_put_contents($compiled_file,$compile_file_content);
		}
		require("$compiled_file");
	}
}
?>
