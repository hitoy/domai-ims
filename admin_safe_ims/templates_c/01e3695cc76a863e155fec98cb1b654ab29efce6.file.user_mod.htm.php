<?php /* Smarty version Smarty-3.1.16, created on 2015-08-17 02:43:31
         compiled from ".\templates\user_mod.htm" */ ?>
<?php /*%%SmartyHeaderCode:830955d14a53054be6-25261794%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '01e3695cc76a863e155fec98cb1b654ab29efce6' => 
    array (
      0 => '.\\templates\\user_mod.htm',
      1 => 1392338353,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '830955d14a53054be6-25261794',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'templateurl' => 0,
    'username' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55d14a530a6286_04210833',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55d14a530a6286_04210833')) {function content_55d14a530a6286_04210833($_smarty_tpl) {?><!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>修改用户</title>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templateurl']->value;?>
/style/admin.css"/>
<script src="<?php echo $_smarty_tpl->tpl_vars['templateurl']->value;?>
/script/my.js"></script>
<script>
function checkinput(){
	var password=document.getElementsByName("password")[0].value;
	var password_ag=document.getElementsByName("password_ag")[0].value;
	if(password==""){
		alert("输入为空!");
		return false;
	}else if(password.length<5){
		alert("密码过于简单!");
		return false;
	}else if(password!=password_ag){
		alert("两次输入密码不相同!");
		return false;
	}
}
</script>
</head>
<body>
<div class="user_admin">
<div class="title"><a href="javascript:window.top.location.reload()">首页</a> > 用户管理</div>	
<table class="user_mod">
<form action="" method="post" onsubmit="return checkinput()">
	<tr><td>用户名:</td><td><input type="text" name="uname" disabled="disabled" value="<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
"/></td></td>
<tr><td>输入密码:</td><td><input type="password" name="password"/></td></tr>
<tr><td>再次输入密码:</td><td><input type="password" name="password_ag"/></td></tr>
<tr><td colspan="2"><input type="submit" value="保存" class="butn"/><input type="reset" value="返回" class="butn" onclick="window.history.go(-1);"/></td></tr>
</form>
</table>
</div>
</body>
</html>
<?php }} ?>
