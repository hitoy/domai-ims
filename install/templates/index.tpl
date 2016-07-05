<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<meta charset="UTF-8">
<title>安装留言管理系统</title>
<meta name="author" content="hito,www.hitoy.org"/>
<style>
table {width:500px;margin:0px auto}
table td{border:1px solid #ccc;text-align:center;padding:4px 2px}
</style>
</head>
<body>
<center><h1>安装须知</h1></center>
<p>哆麦外贸网站询盘管理系统是一套开源的留言询盘管理系统，遵循MIT协议，您有权利使用、复制、修改、合并、出版发布、散布、再授权和/或贩售软件及软件的副本，及授予被供应人同等权利，在必须在软件和软件的所有副本中都必须包含以上版权声明和本许可声明。</p>
<p>软件作者会根据情况对系统进行改进，但不保证所有问题都予以解决。一切因使用本软件造成的任何意外、疏忽、合约毁坏、诽谤、版权或知识产权侵犯及其所造成的损失，作者概不负责，亦不承担任何法律责任。您使用本软件即表示同意遵循MIT协议以及相关免责声明，否则，请立即停止使用本软件。</p>
<p>1，前台运行要求：浏览器必须为支持Javascript，开启Cookie的高级浏览器，如果使用IE8以下（包括IE8），可能会影响操作体验。</p>
<p>2，后台运行要求：PHP版本5.0以上，Mysql版本5.0以上，为保证系统运行效率，服务器推荐使用linux+Nginx，使用APC或eaccelerator等PHP加速器。</p>
<br/>
<center><h2>安装检测</h2></center>
<table>
<tr>
<td>检测项目</td><td>系统要求</td><td>实际配置</td>
</tr>
<tr>
<td>PHP版本</td><td>5.2</td><td><?php echo phpversion();?></td>
</tr>
<tr>
<td colspan="3">目录权限检测</td>
</tr>
<tr>
<td>/</td><td>读取+写入</td><td><?php echo getmod("/");?></td>
</tr>
<tr>
<td>install/</td><td>读取+写入</td><td><?php echo getmod("install/");?></td>
</tr>
<tr>
<td>caches/</td><td>读取+写入</td><td><?php echo getmod("caches/");?></td>
</tr>
<tr>
<td>safe/</td><td>读取+写入</td><td><?php echo getmod("safe/");?></td>
</tr>
<tr>
<td>templates/templates_compile/</td><td>读取+写入</td><td><?php echo getmod("templates/templates_compile");?></td>
</tr>
<tr>
<td>admin_safe_ims/</td><td>读取+写入</td><td><?php echo getmod("admin_safe_ims/");?></td>
</tr>
<tr>
<td>admin_safe_ims/session</td><td>读取+写入</td><td><?php echo getmod("admin_safe_ims/session/");?></td>
</tr>
<tr>
<td>admin_safe_ims/logs</td><td>读取+写入</td><td><?php echo getmod("admin_safe_ims/logs/");?></td>
</tr>
</table>
<br/>
<form action="" method="GET">
<input type="hidden" value="1" name="step"/>
<center><input type="submit" value="开始安装"></center>
</form>
</body>
</html>
