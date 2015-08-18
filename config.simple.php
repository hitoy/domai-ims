<?php
/*************************************
 * 系统配置文件 杨海涛 2014年2月16日 *
 ************************************/

/*
Copyright (C) 2015 杨海涛(vip@hitoy.org)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

//数据库配置
$cfg["dbhost"]="";
$cfg["dbuser"]="";
$cfg["dbpassword"]="";
$cfg["dbname"]="";
$cfg["prefix"]="";
$cfg["lang"]="utf8";

/*****************************************
 * 多语言配置*****************************
 * 开启多语言配置会根据网站用户的设置对不同语言的客户提示不同的语言
 ****************************************/
$cfg["Mulang"]= true;

/*****************************************
 * 是否开启控制特定IP用户不让提交*********
 *开启的话系统会根据指定的IP屏蔽其提交信息*/
$cfg["ipctl"]= false;

/*****************************************
 * 提交间隔控制 cookie********************
 * 控制同一个用户的提交时间单位秒，0关闭*/
$cfg["subctl_bycookie"]= 0;

/*****************************************
 * 连续提交控制 根据IP********************
 * 控制相同IP一段时间内的提交次数，0关闭*/
$cfg["subctl_byip"]= 0;

/*****************************************
 * 前台提交提示信息缓存，单位秒***********
 *****************************************/
$cfg["cachetime"]= 36000;

/*****************************************
 * 前台显示模板路径，根目录下templates目录
 ****************************************/
$cfg["tpldir"]="default";

//debug设置
//define("debug",true);
if(defined("debug")&&debug==true){
error_reporting(E_ALL);
}else{
error_reporting(0);
}
?>
