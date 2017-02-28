<?php
/**********************************
 * 用户类 杨海涛 2014年1月13日*
 * *******************************/

/*
Copyright (C) 2015 杨海涛(vip@hitoy.org)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

class User {
    private $username;
    private $password;
    private $userleve;
    public $logerrormsg;//登陆失败的原因
    public function __construct(){
        $this->autologin=isset($_POST["autologin"])?$_POST["autologin"]:"off";	
    }

    //登陆
    public function checkUser($u,$p){
        global $mysql;//实例化的mysql对象
        $p=sha1($p);
        $sql="select current_stat,userleve,sessionid from ims_user where username=\"$u\" and password=\"$p\"";
        $mysql->setQuery($sql);
        if(!$result=$mysql->getOne()){
            $this->logerrormsg="用户名或密码错误!";
            return false;
        }else{
            //保存当前用户
            $this->username=$u;
            $this->password=$p;
            $this->userleve=$result[1];
            /*踢出已经登陆的其它用户*/
            if($result[2]!==session_id()){
                unlink(ADMINROOT."session/sess_".$result[2]);
            }
            return true;
        }
    }
    //保存当前用户
    public function keepUser(){
        global $mysql;
        $_SESSION["uname"]=$this->username;
        $_SESSION["ulv"]=$this->userleve;
        //更新当前用户在线状态，并写入session
        $sql="update ims_user set current_stat=\"online\",sessionid = \"".session_id()."\" where username=\"$this->username\"";
        $mysql->setQuery($sql);
        $mysql->query();
        //获取登陆时间并保存为session以便系统退出时保存上次登陆时间
        $mysql->setQuery("select now()");
        $lastlogintime=$mysql->getOne();
        $_SESSION["lastlogtime"]=$lastlogintime[0];
        //写入访问日志
        global $accesslog;
        $accesslog->setlog("登陆系统!");
    }

    //退出
    public function logout(){
        //写入访问日志
        global $accesslog;
        $accesslog->setlog("退出系统!");
        //销毁session并更新用户状态
        $lastlogtime=$_SESSION["lastlogtime"];//获取本次登陆时间
        $u=$_SESSION["uname"];
        session_destroy();
        //更新用户状态为未登录
        global $mysql;
        $ip=$_SERVER['REMOTE_ADDR'];//本次登陆ip
        //获取登陆次数
        $mysql->setQuery("select logcount from ims_user where username=\"$u\"");
        $log=$mysql->getOne();
        $logcount=$log[0]+1;
        $sql="update ims_user set current_stat=\"offline\",lastlogip=\"$ip\",logcount=\"$logcount\",lastlogin=\"$lastlogtime\" where username=\"$u\"";
        $mysql->setQuery($sql);
        $mysql->query();
    }
}
?>
