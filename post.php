<?php
/***************************
 *留言信息的前台接收页面
 *杨海涛 2013年12月18日
 ***************************/

/*
Copyright (C) 2015 杨海涛(vip@hitoy.org)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */


//如果没有提交请求，则退出执行
if(!$_POST){
    header("HTTP/1.1 404 Not Found");
    exit();
}

//初始化执行环境
require_once("./include/init.php");


/*用错误代码表示最终的信息处理结果
 * $errorcode:
 * 0, 提交成功 其余为失败
 * 1, 禁止提交，IP被管理员屏蔽
 * 2, 提交过于频繁 基于IP池的判定
 * 3, 提供过于频繁，基于Cookie的判定
 * 4, 用户名为空
 * 5, 邮箱为空或者格式不正确
 * 6, 主要信息为空
 * 7, 数据库错误
 * 8, 其它错误
 */


//根据是否设置多语言显示来实例化对象
if($sysconf->Mulang){
    $lang=isset($_GET["lang"])?$_GET["lang"]:(isset($_POST["lang"])?$_POST["lang"]:"en");
}else{
    $lang="en";
}
$userlang=new Language($lang);
//获取客户端要求的返回对象
$responsemimetype = isset($_GET['format'])?$_GET['format']:(isset($_POST['format'])?$_POST['format']:"html");

//下面的留言的公有信息，其它类会用到，所以把它们放到前面
$team=(empty($_POST["team"]))?"郑州":$_POST["team"];   //信息分组
$ip_add=$_SERVER["REMOTE_ADDR"];			//信息提交IP
$http_referer=$_SERVER["HTTP_REFERER"];		//HTTP来源
$user_agent=$_SERVER["HTTP_USER_AGENT"];	//提交信息设备


//管理员启用屏蔽固定IP提交功能的情况
if($sysconf->ipctl){
    require_once(MSGROOT."include/acl.class.php");
    $ip_contrl=new Acl();
    if($ip_contrl->is_forbid($ip_add)){
        //如果当前用户IP被管理员禁止，则错误代码为1;
        $errorcode=1;
        //goto view;
        showui($errorcode,$responsemimetype);
        exit();
    }
}

//加载信息类并实例化,可能存在IP被禁止的情况，所以放到后面加载
require_once(MSGROOT."include/message.class.php");
$msg_ins=new Msg($team,$ip_add,$http_referer,$user_agent);

//管理员启用IP提交控制的情况(限制相同IP多次提交)
if($sysconf->subctl_byip>0){
    if($msg_ins->getsubcount()>$sysconf->subctl_byip){
        //如果当前提交IP超过系统限制，则错误代码为2;
        $errorcode=2;
        showui($errorcode,$responsemimetype);
        //goto view;
        exit();
    }
}


//管理员启动根据Cookie判定指定时间内不能重复提交
if($sysconf->subctl_bycookie>0){
    if($msg_ins->getsubinterval()<$sysconf->subctl_bycookie){
        //如果两次提交间隔小于系统设置，则错误代码为3;
        $errorcode=3;
        showui($errorcode,$responsemimetype);
        //goto view;
        exit();
    }
}

//下面的信息是随表单提交过来的信息
@$name=$_POST['name'];					//客户姓名，必须
@$email=$_POST['email'];				//客户邮箱，必须
@$message=$_POST['message'];			//具体留言内容，必须
@$tel=$_POST['tel'];					//客户电话，非必须
@$company=$_POST['company'];			//新加入公司这一项，非必须
@$product=$_POST['product'];			//客户需求产品，非必须
@$country=$_POST['country_name'];		//客户所在国家，由客户自己填写，非必须
@$url=$_POST['url'];					//留言url地址，由Javascript获取，非必须
@$lang=$lang;							//客户使用语言,由网站管理员设定，非必须，默认为英语

//把留言内容拼接成数组,并添加到留言对象当中
$maindata=array("name"=>$name,"email"=>$email,"message"=>$message,"tel"=>$tel,"company"=>$company,"product"=>$product,"country"=>$country,"url"=>$url,"lang"=>$lang);

$msg_ins->setmaindata($maindata);

//获取sql语言，如果返回结果为数字，则是因为必填项不合法
$sql=$msg_ins->getsql();

//如果$sql为整数，则用户输入出现错误,否则，则提交数据库
if(gettype($sql)=="integer"){
    $errorcode=$sql;
    showui($errorcode,$responsemimetype);
    //goto view;
    exit();
}else{
    //加载数据库类,并实例化
    require_once(MSGROOT."include/db.class.php");
    $mysql=new Mysql($sysconf->dbhost,$sysconf->dbuser,$sysconf->dbpassword,$sysconf->dbname,$sysconf->prefix,$sysconf->lang);
    $mysql->setQuery($sql);
    $mysql->query();
    //获取mysql的执行错误代码
    $errorcode=$mysql->get_error();
    showui($errorcode,$responsemimetype);
    exit();
}


//其它未知错误
$errorcode=8;
showui($errorcode,$responsemimetype);

//当检查到错误代码出现时，直接程序直接跳转到这里
//新增ajax, 要求IE10+(包含)
//执行结果展示
//PHP5.2以上版本
function showui($errorcode,$mimetype="html"){
    global $userlang,$timer,$sysconf;

    //获取相关提示语言
    $userlang->prompt($errorcode);
    //提示标题
    $title=$userlang->notice['title'];
    //提示内容
    $body=$userlang->notice['body'];
    //程序执行时间
    $exetime=$timer->spend();

    if($mimetype=="json"){
        header("Content-Type:application/json");
        header("Access-Control-Allow-Methods:POST,GET");
        if($_SERVER["HTTP_ORIGIN"]){
            header("Access-Control-Allow-Origin: ".$_SERVER["HTTP_ORIGIN"]);
        }else{
            header("Access-Control-Allow-Origin: *");
        }
        header("Access-Control-Allow-Credentials: true");
        //header("Access-Control-Expose-Headers: true");
        printf("{\"code\":%d,\"title\":\"%s\",\"body\":\"%s\",\"exetime\":%s}",$errorcode,$title,preg_replace("/[\r\n\t]/i","",addslashes($body)),$exetime);
    }else if($mimetype=="html"){
        //实例化模板并显示
        $myview=new Template($sysconf->tpldir);
        $myview->assign("lang",$lang);
        $myview->assign("title",$title);
        $myview->assign("body",$body);
        $myview->assign("tempurl","/templates/".$sysconf->tpldir);
        $myview->assign("exetime",$exetime);
        $myview->display();
    }
}
