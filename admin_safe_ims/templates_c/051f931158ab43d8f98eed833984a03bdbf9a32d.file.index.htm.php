<?php /* Smarty version Smarty-3.1.16, created on 2015-08-17 02:20:37
         compiled from ".\templates\index.htm" */ ?>
<?php /*%%SmartyHeaderCode:1156955d144f5abeef2-40186285%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '051f931158ab43d8f98eed833984a03bdbf9a32d' => 
    array (
      0 => '.\\templates\\index.htm',
      1 => 1392352861,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1156955d144f5abeef2-40186285',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55d144f5bd8314_39640445',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55d144f5bd8314_39640445')) {function content_55d144f5bd8314_39640445($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("head.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div id="leftnav">
	<iframe src="./left_nav.html" name="leftnav" frameborder="0" scrolling="yes"></iframe>
</div>
<div id="main">
<iframe src="./index_body.php" name="main" frameborder="0" scrolling="yes"></iframe>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("footer.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
