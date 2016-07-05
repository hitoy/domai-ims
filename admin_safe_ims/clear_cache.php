<?php
/***********************************************
 * 清理前台提交提示的缓存 杨海涛 2014年2月14日 *
 ***********************************************/

/*
Copyright (C) 2015 杨海涛(vip@hitoy.org)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
session_start();
$cachedir=opendir("../caches/") or exit("失败，缓存目录不存在或不可读取!");
while($file=readdir($cachedir)){
    if($file=="."||$file=="..") continue;
    echo unlink("../caches/".$file)?"清除".$file."成功!<br/>":"清除".$file."失败!<br/>";
}
$cachedir=opendir("./session/") or exit("失败，缓存目录不存在或不可读取");
while($file=readdir($cachedir)){
    if($file=="."||$file==".."||$file=="sess_".session_id()) continue;
    echo unlink("./session/".$file)?"清除".$file."成功!<br/>":"清除".$file."失败!<br/>";
}
echo "完成!";
