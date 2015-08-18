<?php /* Smarty version Smarty-3.1.16, created on 2015-08-17 03:50:26
         compiled from ".\templates\msg.htm" */ ?>
<?php /*%%SmartyHeaderCode:879755d15a0277fd10-47962585%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '335b47166c683c38c6ae964757cae8d78a83361c' => 
    array (
      0 => '.\\templates\\msg.htm',
      1 => 1392277519,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '879755d15a0277fd10-47962585',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'templateurl' => 0,
    'id' => 0,
    'name' => 0,
    'subtime' => 0,
    'country' => 0,
    'url' => 0,
    'email' => 0,
    'referer' => 0,
    'tel' => 0,
    'ip' => 0,
    'product' => 0,
    'lang' => 0,
    'company' => 0,
    'status' => 0,
    'team' => 0,
    'deal_person' => 0,
    'deal_time' => 0,
    'message' => 0,
    'ulv' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55d15a0282ba00_12270719',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55d15a0282ba00_12270719')) {function content_55d15a0282ba00_12270719($_smarty_tpl) {?><!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<meta charset="UTF-8">
<title>信息管理</title>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templateurl']->value;?>
/style/admin.css"/>
<script src="<?php echo $_smarty_tpl->tpl_vars['templateurl']->value;?>
/script/my.js"></script>
<script>
	//ajax 处理信息
	function deal_msg(){
		var obj=document.getElementsByName("action");
		var action="";
		for(var i=0;i<obj.length;i++){
			var actionlist=obj[i];
			if(actionlist.checked){
				action=actionlist.value;
			}
		}
		if(action==""){
			alert("请选择处理方式!");
			return false;
		}
		var xmlhttp;
		if(window.XMLHttpRequest){
			xmlhttp=new XMLHttpRequest();
		}else if(window.ActiveXObject){
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.open("POST","./msg.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("action="+action+"&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
");
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState==4 && xmlhttp.status==200){
				response=xmlhttp.responseText.match(/^[^<]+/);
				var note=document.createElement("div");
				note.style.position="fixed";
				note.style.top="10px";
				note.style.left="45%"
				note.style.height="30px";
				note.style.padding="0 10px";
				note.style.lineHeight="30px";
				note.style.background="#DFA4A4";
				note.style.color="rgb(92, 137, 204)";
				note.innerHTML=response;
				document.body.appendChild(note);
				note.style.marginLeft="-"+note.offsetWidth/2+"px";
				setTimeout(function(){
					document.body.removeChild(note);
					//window.location="./msg_list.php"
				},1500)
			}
		}
		return false;
	}
	$.ready(function(){
		var ipadd=document.getElementById("c_ipadd").innerHTML;
		var show_obj=document.getElementById("checkip");
		var xmlhttp;
		if(window.XMLHttpRequest){
			xmlhttp=new XMLHttpRequest();
		}else if(window.ActiveXObject){
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.open("GET","./tools/checkipadd.php?ipadd="+ipadd,true);
		xmlhttp.send();
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState==4 && xmlhttp.status==200){
				show_obj.innerHTML=xmlhttp.responseText;
			}else if(xmlhttp.readyState==4 && xmlhttp.status!=200){
				show_obj.innerHTML="自动查询失败，请手动查询!";
			}
		}
	})
</script>
</head>
<body style="padding-bottom:50px">
<div class="msg_admin">
<div class="title"><a href="javascript:window.top.location.reload()">首页</a> &gt; <a href="./msg_list.php">信息管理</a></div>
<table class="msgbox">
	<tr>
		<td>客户姓名</td><td><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</td>
		<td>提交时间</td><td><?php echo $_smarty_tpl->tpl_vars['subtime']->value;?>
</td>
	</tr>
	<tr>
		<td>国家(用户填写)</td><td><?php echo $_smarty_tpl->tpl_vars['country']->value;?>
</td>
		<td>来源</td><td><?php echo $_smarty_tpl->tpl_vars['url']->value;?>
</td>
	</tr>
	<tr>
		<td>客户邮箱</td><td><?php echo $_smarty_tpl->tpl_vars['email']->value;?>
</td>
		<td>真实来源</td><td><?php echo $_smarty_tpl->tpl_vars['referer']->value;?>
</td>
	</tr>
	<tr>
		<td>客户电话</td><td><?php echo $_smarty_tpl->tpl_vars['tel']->value;?>
</td>
		<td>客户IP</td><td><a href="http://www.baidu.com/s?wd=<?php echo $_smarty_tpl->tpl_vars['ip']->value;?>
" target="_blank" title="点击手动查询" id="c_ipadd"><?php echo $_smarty_tpl->tpl_vars['ip']->value;?>
</a><span id="checkip">正在自动查询IP归属地...</span></td>
	</tr>
	<tr>
		<td>需求产品</td><td><?php echo $_smarty_tpl->tpl_vars['product']->value;?>
</td>
		<td>语种</td><td><?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
</td>
	</tr>
	<tr>
		<td>公司</td><td><?php echo $_smarty_tpl->tpl_vars['company']->value;?>
</td>
		<td>询盘状态</td><td><?php echo $_smarty_tpl->tpl_vars['status']->value;?>
</td>
	</tr>
	<tr>
		<td>分组</td><td style="color:red"><?php echo $_smarty_tpl->tpl_vars['team']->value;?>
</td>
		<td>处理人及时间:</td><td><?php echo $_smarty_tpl->tpl_vars['deal_person']->value;?>
 : <?php echo $_smarty_tpl->tpl_vars['deal_time']->value;?>
</td>
	</tr>
	<tr class="mainbox">
		<td style="padding-left:10px">消息内容</td>
		<td colspan="3"><textarea><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</textarea></td>
	</tr>
	<form action="" method="POST" onsubmit="return deal_msg()">
	<tr>
		<td>是否处理</td><td colspan="3">
		<input type="radio" name="action" value="right"/>有效 
		<input type="radio" name="action" value="wrong"/>无效 
		<input type="radio" name="action" value="repeat"/>重复 
		<?php if ($_smarty_tpl->tpl_vars['ulv']->value==1) {?><input type="radio" name="action" value="del"/>删除<?php }?>
		<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"/>
		<input type="submit" value="确认处理" class="btn"/>
		<a href="javascript:window.location='./msg_list.php';" class="goback">返回上一页</a></td>
	</tr>
	<tr>
		<td colspan="4">
			<a href="./msg.php?id=<?php echo $_smarty_tpl->tpl_vars['id']->value+1;?>
" class="next_article">上一篇</a>
			<a href="./msg.php?id=<?php echo $_smarty_tpl->tpl_vars['id']->value-1;?>
" class="next_article">下一篇</a></td>
	</tr>
</form>
</table>
</div>
</body>
</html>
<?php }} ?>
