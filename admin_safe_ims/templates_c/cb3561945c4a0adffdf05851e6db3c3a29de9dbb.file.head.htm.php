<?php /* Smarty version Smarty-3.1.16, created on 2015-08-18 02:36:28
         compiled from ".\templates\head.htm" */ ?>
<?php /*%%SmartyHeaderCode:2357455d144f5c209f8-61393176%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cb3561945c4a0adffdf05851e6db3c3a29de9dbb' => 
    array (
      0 => '.\\templates\\head.htm',
      1 => 1439865315,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2357455d144f5c209f8-61393176',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55d144f5ca8608_36008500',
  'variables' => 
  array (
    'templateurl' => 0,
    'user' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55d144f5ca8608_36008500')) {function content_55d144f5ca8608_36008500($_smarty_tpl) {?><!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<meta charset="UTF-8">
<title>哆麦外贸询盘管理系统</title>
<meta name="author" content="www.hitoy.org"/>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templateurl']->value;?>
/style/main.css"/>
<script src="<?php echo $_smarty_tpl->tpl_vars['templateurl']->value;?>
/script/my.js"></script>
<script>
window.onbeforeunload=function(){
	return value="如果您要退出系统，请点击注销按钮，不然下次系统会登陆不上!";
}
</script>
</head>
<body>
<div class="head">
<a href="#" onclick="window.location.reload();return false;"><img src="<?php echo $_smarty_tpl->tpl_vars['templateurl']->value;?>
/image/managelog.gif" alt="Logo" id="logo"/></a>
<div class="wel">您好:<?php echo $_smarty_tpl->tpl_vars['user']->value;?>
, 欢迎进入哆麦外贸询盘管理系统! <a href="./exit.php" class="logout">[注销]</a></div>
<div class="menu">
<ul class="nav">
<li class="selected" onclick="$.selectnav(this,'selected');window.main.location='./index_body.php';">首 页</li>
<li onclick="$.selectnav(this,'selected');window.main.location='./sys_setting.php';">系统配置</li>
<li onclick="$.selectnav(this,'selected');window.main.location='./msg_list.php';">信息管理</li>
<li onclick="$.selectnav(this,'selected');window.main.location='./user_list.php';">用户管理</li>
</ul>
<div class="easyop" onmouseover="$.submenushow('submenu')">快捷操作</div>
<ul class="easymenu" id="submenu" onmouseout="$.submenuhide(event,this)">
<li><a href="./recycle.php" target="main">回收站</a></li>
<li><a href="./user_do.php?action=add" target="main">添加用户</a></li>
<li><a href="./msg_list.php" target="main">信息管理</a></li>
<!--<li><a href="./sys_setting.php" target="main">登陆权限</a></li>-->
</ul>
</div>
<?php }} ?>
