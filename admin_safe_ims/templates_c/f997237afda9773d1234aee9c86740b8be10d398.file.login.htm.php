<?php /* Smarty version Smarty-3.1.16, created on 2015-08-17 01:21:30
         compiled from ".\templates\login.htm" */ ?>
<?php /*%%SmartyHeaderCode:939855d1371a20bf20-02428658%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f997237afda9773d1234aee9c86740b8be10d398' => 
    array (
      0 => '.\\templates\\login.htm',
      1 => 1392614924,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '939855d1371a20bf20-02428658',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'templateurl' => 0,
    'errormsg' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55d1371a287a81_37942671',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55d1371a287a81_37942671')) {function content_55d1371a287a81_37942671($_smarty_tpl) {?><!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<meta charset="UTF-8">
<title>网站留言管理系统 - 黎明重工科技股份有限公司</title>
<meta name="author" content="www.hitoy.org"/>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templateurl']->value;?>
/style/login.css"/>
</head>
<body>
<div class="loginbox">
	<table>
		<form action="./login.php" method="post">
			<tr><td>用户名:</td><td><input name="username" type="text" class="key" autofocus="autofocus"/></td></tr>
			<tr><td>密  码:</td><td><input name="password" type="password" class="key" /></td></tr>
			<tr><td>&nbsp;</td><td class="resbox"><?php echo $_smarty_tpl->tpl_vars['errormsg']->value;?>
</td></tr>
			<tr><td colspan="2" class="discet"><input type="image" name="login" src="<?php echo $_smarty_tpl->tpl_vars['templateurl']->value;?>
/image/submit.gif" value="login"/></td></tr>
		</form>	
	</table>
</div>	
<div class="note">为保证良好的操作效果，请使用<a href="https://www.google.com/intl/en/chrome/browser/" target="_blank">Chrome</a>等高级浏览器</div>
</body>
</html>
<?php }} ?>
