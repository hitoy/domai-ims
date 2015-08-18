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
<p>外贸询盘管理系统，Powered By <a href="https://www.hitoy.org/">Hito</a></p>
<p>1，前台运行要求：浏览器必须为支持Javascript，开启Cookie的高级浏览器，如果使用IE8以下（包括IE8），可能会影响操作体验。</p>
<p>2，后台运行要求：PHP版本5.3以上，Mysql版本5.0以上，为保证系统运行效率，服务器推荐使用linux+Nginx，使用APC或eaccelerator等PHP加速器。</p>
<p>3，系统可能存在未知漏洞，请妥善管理源码。</p>
<br/>
<center><h2>安装检测</h2></center>
<table>
<tr>
<td>检测项目</td><td>系统要求</td><td>实际配置</td>
</tr>
<tr>
<td>PHP版本</td><td>5.3</td><td><?php echo phpversion();?></td>
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
