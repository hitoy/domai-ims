<?php
/**********************************
 * 系统安装类 杨海涛2014年2月19日 *
 *********************************/
class Install{
	private $step;
	public function __construct(){
		$this->step=isset($_GET["step"])?$_GET["step"]:0;
	}

	public function showstep(){
		if($this->step==0){
			//默认系统显示
			include "templates/index.tpl";
		}
		if ($this->step==1){
			//第一步安装，首先清空指定目录下的文件
			$this->clearcontent('safe',true);
			$this->clearcontent('caches',false);
			$this->clearcontent('admin_safe_ims/logs',false);
			$this->clearcontent('templates/templates_compile/',false);
			include "templates/step1.tpl";
		}
		if($this->step==2){
			$host=trim($_POST["dhost"]);
			$database=trim($_POST["dname"]);
			$user=trim($_POST["duname"]);
			$passwd=trim($_POST["dpasswd"]);
			$prefix=trim($_POST["dprefix"]);

			//往配置文件里写入数据库信息
			$conffile=file_get_contents(MSGROOT."config.simple.php");
			$pattern=array("/(cfg\[\"dbhost\"\]=)([^;]+);/i","/(cfg\[\"dbuser\"\]=)([^;]+);/i","/(cfg\[\"dbpassword\"\]=)([^;]+);/i","/(cfg\[\"dbname\"\]=)([^;]+);/i","/(cfg\[\"prefix\"\]=)([^;]+);/i");
			$replace=array("$1 "."\"".$host."\";","$1 "."\"".$user."\";","$1 "."\"".$passwd."\";","$1 "."\"".$database."\";","$1 "."\"".$prefix."\";");
			$conffile=preg_replace($pattern,$replace,$conffile);

			//创建数据库
			$sql=trim(file_get_contents(MSGROOT."install/install.sql"));
			$sql_arr=explode("Create table ims_",$sql);
			array_shift($sql_arr);
			require(MSGROOT."include/db.class.php");
			$mysql=new Mysql($host,$user,$passwd,$database,$prefix);
			foreach($sql_arr as $sql){
				$sql="Create table ims_".$sql;
				$mysql->setQuery($sql);
				$mysql->query();
			}
			$error1=$mysql->get_error();
			//获取要创建的用户名和密码
			$admin=trim($_POST['uname']);
			$name=trim($_POST['trname']);
			$upasswd=sha1(trim($_POST['upasswd']));
			$createuser="insert into ims_user(username,password,userleve,nickname) values (\"$admin\",\"$upasswd\",1,\"$name\")";
			$mysql->setQuery($createuser);
			$mysql->query();
			$error2=$mysql->get_error();
			if($error1>0||$error2>0){
				echo "安装过程中似乎哪里出错了，请检查或者手动编辑根目录下的config.simple.php并改名为config.php文件";
			}else{
				echo "系统安装成功,正在转向管理后台!";
				//写入安装锁定文件
				file_put_contents(MSGROOT."install/install.lock","If you want to reinstall the system,please remove this file!");
				//写入新的配置文件
				file_put_contents(MSGROOT."config.php",$conffile);
				echo "<script>setTimeout(function(){window.location.href=\"../admin_safe_ims/\";},1500);</script>";
			}
		}
	}


	//清空指定目录下的文件，$touch表示清空之后是否创建空文件
	private function clearcontent($dir,$touch){
		$dir=MSGROOT.$dir."/";
		$dr=opendir($dir);
		while($fs=readdir($dr)){
			if($fs=="."||$fs=="..") continue;
			$createfile[]=$dir.$fs;
			unlink($dir.$fs);
		}
		if($touch){
			foreach($createfile as $singlefile){
				touch($singlefile);
			}
		}
		closedir($dr);
	}
}
?>
