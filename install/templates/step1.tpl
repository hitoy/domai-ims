<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<meta charset="UTF-8">
<title>安装留言管理系统</title>
<link rel="stylesheet" href="./style/style.css"/>
<script>
function checksub(){
	var obj=document.forms["datadetail"];
	var dhost=trim(obj.dhost.value);
	var duname=trim(obj.duname.value);
	var dpasswd=trim(obj.dpasswd.value);
	var dname=trim(obj.dname.value);
	var uname=trim(obj.uname.value);
	var trname=trim(obj.trname.value);
	var upasswd=trim(obj.upasswd.value);
	var upasswdag=trim(obj.upasswdag.value);
	if(dhost==""){
		alert("数据库地址为空");
		return false;
	}
	if(duname==""){
		alert("数据库用户名为空");
		return false;
	}
	if(dpasswd==""){
		alert("数据库密码为空");
		return false;
	}
	if(dname==""){
		alert("数据库名称为空");
		return false;
	}
	if(uname==""){
		alert("管理员用户名为空");
		return false;
	}
	if(trname==""){
		alert("管理员真实姓名为空");
		return false;
	}
	if(upasswd==""||upasswdag==""){
		alert("管理员密码为空");
		return false;
	}
	if(upasswd!=upasswdag){
		alert("两次输入密码不相同!");
		return false;
	}
}
function trim(str){
	return str.replace(/^\s+/,"").replace(/\s+$/,"");
}
</script>
</head>
<body>
<noscript><center><h1>您的系统不支持javascript，请开启javascript后再进行安装!</h1></center></noscript>
<form action="?step=2" method="post" id="datadetail" onsubmit="return checksub()" name="datadetail">
<table>
<tr><td colspan="2">欢迎使用询盘信息管理系统!<br/><br/>您的浏览器必须支持JS才能完成安装:</td></td></tr>
<tr><td>数据库地址</td><td><input type="text" name="dhost" value="localhost"/></td></tr>
<tr><td>数据库用户名</td><td><input type="text" name="duname" value=""/></td></tr>
<tr><td>数据库密码</td><td><input type="text" name="dpasswd" value=""/></td></tr>
<tr><td>数据库名称</td><td><input type="text" name="dname" value=""/></td></tr>
<tr><td>数据表前缀</td><td><input type="text" name="dprefix" value="ims_"/></td></tr>
<tr><td colspan="2"><b>请设置<u style="color:red">系统管理员</u>相关信息:</b></td></td></tr>
<tr><td>用户名</td><td><input type="text" name="uname" value=""/></td></tr>
<tr><td>真实姓名</td><td><input type="text" name="trname" value="管理员"/></td></tr>
<tr><td>密码</td><td><input type="password" name="upasswd" value=""/></td></tr>
<tr><td>再次输入密码</td><td><input type="password" name="upasswdag" value=""/></td></tr>
<tr><td colspan="2"><input type="submit" value="安装"/></td></td></tr>
</table>
</form>	
</body>
</html>
