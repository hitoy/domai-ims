<?php
/***********************************
初始化文件，所有文件均需要调用此文件
*******杨海涛 2013年12月18日********
************************************/

/*
Copyright (C) 2015 杨海涛(vip@hitoy.org)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

define("MSGROOT",str_replace("\\","/",dirname(dirname(__FILE__)))."/");//网站的根目录
require_once(MSGROOT."include/timer.class.php");
$timer=new Timer();
//加载系统配置类，并实例化
require_once(MSGROOT."include/conf.class.php");
$sysconf=Conf::getIns();
//加载系统提示语言
require_once(MSGROOT."include/language.class.php");
//加载模板类
require_once(MSGROOT."include/template.class.php");
?>
