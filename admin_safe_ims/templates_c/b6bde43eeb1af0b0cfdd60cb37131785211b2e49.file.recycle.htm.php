<?php /* Smarty version Smarty-3.1.16, created on 2015-08-17 02:45:34
         compiled from ".\templates\recycle.htm" */ ?>
<?php /*%%SmartyHeaderCode:1855555d14ace2ee388-67093123%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b6bde43eeb1af0b0cfdd60cb37131785211b2e49' => 
    array (
      0 => '.\\templates\\recycle.htm',
      1 => 1392353241,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1855555d14ace2ee388-67093123',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'templateurl' => 0,
    'msg_list' => 0,
    'pageinfo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55d14ace403b17_26450941',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55d14ace403b17_26450941')) {function content_55d14ace403b17_26450941($_smarty_tpl) {?><!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<meta charset="UTF-8">
<title>回收站管理</title>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templateurl']->value;?>
/style/admin.css"/>
<script src="<?php echo $_smarty_tpl->tpl_vars['templateurl']->value;?>
/script/my.js"></script>
<script>
var i=0;
function selectall(){
	var obj=document.getElementsByTagName("table")[0].getElementsByTagName('input');
	if(i%2==0){
		for(var j=1;j<obj.length;j++){
			obj[j].checked="checked";
		}
	}else{
		for(var j=1;j<obj.length;j++){
			obj[j].checked="";
		}
	}
	i++;
}
function selectno(){
	var obj=document.getElementsByTagName("table")[0].getElementsByTagName('input');
	for(var j=1;j<obj.length;j++){
		if(obj[j].checked){
			obj[j].checked=false;
		}else{
			obj[j].checked="checked";
		}
	}
}
//ajax 处理信息
function deal_msg(action){
	var obj=document.getElementsByTagName("table")[0].getElementsByTagName('input');
	var msg_list=new Array();
	var i=0;
	for(var j=1;j<obj.length;j++){
		if(obj[j].checked){
			msg_list[i]=obj[j].value;
			i++;
		}
	}
	if(msg_list==""){
		alert("请选择!");
		return false;
	}
	var xmlhttp;
	if(window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}else if(window.ActiveXObject){
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
		xmlhttp.open("POST","./recycle.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("action="+action+"&id="+msg_list);
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState==4 && xmlhttp.status==200){
				window.location.reload();
		}
	}
}
</script>
</head>
<body style="padding-bottom:50px;">
<div class="msg_admin">
<div class="title"><a href="javascript:window.top.location.reload()">首页</a> &gt; 回收站</div>
<table class="msg_list">
<tr><td><input type="checkbox" value="0" onclick="selectall()"/></td><td>ID</td><td>客户姓名</td><td>客户邮箱</td><td>国家</td><td>产品</td><td>提交时间</td><td>分组</td><td>处理人</td></tr>

<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['list'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['list']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['list']['name'] = 'list';
$_smarty_tpl->tpl_vars['smarty']->value['section']['list']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['msg_list']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['list']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['list']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['list']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['list']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['list']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['list']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['list']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['list']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['list']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['list']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['list']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['list']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['list']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['list']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['list']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['list']['total']);
?> 
<tr>
	<td><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['msg_list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['id'];?>
"/></td>
	<td><?php echo $_smarty_tpl->tpl_vars['msg_list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['id'];?>
</td>
	<td><?php echo $_smarty_tpl->tpl_vars['msg_list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['name'];?>
</td>
	<td><?php echo $_smarty_tpl->tpl_vars['msg_list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['email'];?>
</td>
	<td><?php echo $_smarty_tpl->tpl_vars['msg_list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['country'];?>
</td>
	<td><?php echo $_smarty_tpl->tpl_vars['msg_list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['product'];?>
</td>
	<td><?php echo $_smarty_tpl->tpl_vars['msg_list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['subtime'];?>
</td>
	<td><?php echo $_smarty_tpl->tpl_vars['msg_list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['team'];?>
</td>
	<td><?php echo $_smarty_tpl->tpl_vars['msg_list']->value[$_smarty_tpl->getVariable('smarty')->value['section']['list']['index']]['deal_person'];?>
</td>
</tr>
<?php endfor; endif; ?>

<tr>
	<td colspan="9" class="selectbar">选择:<a href="javascript:selectall();">全选</a><a href="javascript:selectno();">反选</a>
</tr>
<tr>
	<td colspan="9" class="deal">
	<button onclick="deal_msg('del');return false;">彻底删除</button>
	<button onclick="deal_msg('restore');return false;">恢复</button>
<div id="page">
	<?php echo $_smarty_tpl->tpl_vars['pageinfo']->value;?>

</div></td>
</tr>
</table>
<div>
</body>
</html>
<?php }} ?>
