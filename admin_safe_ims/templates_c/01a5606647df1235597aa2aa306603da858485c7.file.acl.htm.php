<?php /* Smarty version Smarty-3.1.16, created on 2015-08-17 02:44:53
         compiled from ".\templates\acl.htm" */ ?>
<?php /*%%SmartyHeaderCode:1438755d14aa57db165-84526263%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '01a5606647df1235597aa2aa306603da858485c7' => 
    array (
      0 => '.\\templates\\acl.htm',
      1 => 1392367709,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1438755d14aa57db165-84526263',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'templateurl' => 0,
    'denylist' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55d14aa580b608_86778889',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55d14aa580b608_86778889')) {function content_55d14aa580b608_86778889($_smarty_tpl) {?><!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<meta charset="UTF-8">
<title>系统配置</title>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templateurl']->value;?>
/style/admin.css"/>
<script src="<?php echo $_smarty_tpl->tpl_vars['templateurl']->value;?>
/script/my.js"></script>
<style>

.deny {width:350px;max-width:350px;height:380px;max-height:380px;margin-top:5px}

</style>
</head>
<body>	
<div class="sing_count">
		<div class="title"><span style="margin-left:10px">提交控制</span></div>
		<div id="setting">
			在以下列表中的IP将不能提交信息到系统当中，这项功能能够有效固定IP的恶意提交，减少垃圾留言的产生.<br/>
			但供给者可能会利用不同IP或者伪造IP，所以请合理使用这项功能.<br/>
				<form action="" method="POST">
				<textarea class="deny" name="denylist"><?php echo $_smarty_tpl->tpl_vars['denylist']->value;?>
</textarea>
				<button type="submit">保存</button>
				</form>
		</div>
		<hr/>
</div>
</body>
</html>

<?php }} ?>
