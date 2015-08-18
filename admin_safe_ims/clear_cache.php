<?php
/***********************************************
 * 清理前台提交提示的缓存 杨海涛 2014年2月14日 *
 ***********************************************/
	
	$cachedir=opendir("../caches/") or exit("失败，缓存目录不存在或不可度!");
	while($file=readdir($cachedir)){
		if($file=="."||$file=="..") continue;
			echo unlink("../caches/".$file)?"清除".$file."成功!<br/>":"清除".$file."失败!<br/>";
	}
	echo "完成!";
	//echo "<script>setTimeout(function(){window.history.go(-1);},1000)</script>";
?>
