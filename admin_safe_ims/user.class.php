<?php
/***********************************
 * 用户管理类 杨海涛 2014年2月13日 *
 **********************************/

/*
Copyright (C) 2015 杨海涛(vip@hitoy.org)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

class User{
	private $cuser;//当前用户
	private $culv;//当前用户等级

	public function __construct(){
		$this->cuser=$_SESSION["uname"];
		$this->culv=$_SESSION["ulv"];
	}

	//显示用户列表
	public function showuserlist(){
		global $mysql;
		$mysql->setQuery("select id,username,nickname,lastlogin,userleve,current_stat from ims_user");
		$userlist_arr=$mysql->getRows();

		//把用户等级的数字转化为文字
		foreach ($userlist_arr as $userlist){
			switch($userlist["userleve"]){
			case 1:
				$userlist["userleve"]="管理员";
				break;
			default:
				$userlist["userleve"]="操作员";
				break;
			}
			$result_arr[]=$userlist;
		}
		return $result_arr;
	}

	//根据ID获取用户名
	public function getusername($id){
		$id=(int)$id;
		global $mysql;
		$mysql->setQuery("select username from ims_user where id=\"$id\"");
        $uname=$mysql->getOne();
		return $uname[0];
	}

	//添加用户
	public function adduser($name,$passwd,$lv,$nickname){
		//如果当前用户不是管理员，则不能添加!
		if($this->culv>1){
			return "添加失败，权限不足!";
		}else{
			global $mysql;
			$passwd=sha1($passwd);
			$lv=(int)$lv;
			$mysql->setQuery("insert into ims_user(username,password,userleve,nickname) values (\"$name\",\"$passwd\",$lv,\"$nickname\")");
			$mysql->query();
			if($mysql->get_error()==0){
				//写入系统日志
				global $accesslog;
				$accesslog->setlog("添加用户:".$name);
				return "添加成功!";
			}else{
				return "添加失败,未知错误!";
			}
		}
	}
	//更改密码
	public function changepasswd($id,$newpasswd,$passwdag){
		if($newpasswd!=$passwdag) return "更改失败，两次密码不相同!";
		//id为需要更改密码的目标用户id
		$id=(int)$id;
		$newpasswd=sha1($newpasswd);
		//管理员能更改所有密码，用户只能更改自己的密码
		global $mysql;
		$mysql->setQuery("select username from ims_user where id=\"$id\"");
        $tg=$mysql->getOne();
		$tguname=$tg["0"];
		if($this->culv>1 && $this->cuser!=$tguname){
			return "更改密码失败，权限不足!";
		}else{
			$mysql->setQuery("update ims_user set password=\"$newpasswd\" where id=\"$id\"");
			$mysql->query();
			if($mysql->get_error()==0){
				//写入系统日志
				global $accesslog;
				$accesslog->setlog("更改用户密码:ID=".$id);
				return "更改密码成功!";
			}else{
				return "更改密码失败,未知错误!";
			}
		}
	}
	//删除用户
	public function deluser($id){
		$id=(int)$id;
		global $mysql;
		//获取要删除的用户等级
		$mysql->setQuery("select userleve from ims_user where id=\"$id\"");
        $ulv=$mysql->getOne();
		$tgulv=$ulv[0];

		//只能删除比自己权限小的用户
		if($tgulv==""){
			return "非法操作，用户不存在!";	
		}else if($this->culv>=$tgulv){
			return "操作失败，权限不足!";
		}else{
			$mysql->setQuery("delete from ims_user where id=\"$id\"");
			$mysql->query();
			if($mysql->get_error()==0){
				//写入系统日志
				global $accesslog;
				$accesslog->setlog("删除用户:ID=".$id);
				return "删除成功!";
			}else{
				return "删除失败,未知错误!";
			}
		}
	}
}
?>
