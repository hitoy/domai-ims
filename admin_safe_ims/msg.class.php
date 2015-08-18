<?php
/***********************************
 * 留言信息类 杨海涛 2014年2月12日 *
 **********************************/

/*
Copyright (C) 2015 杨海涛(vip@hitoy.org)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

class Msg{

	//--消息类别， 0表示未处理，1表示有效，2表示重复，3表示无效, 9表示已经被删除--
	private $category;
	private $filter;
	//单页显示个数
	private $pagesize;
	//特定条件记录总数
	private $totalsize;
	//总共页面数量
	private $size;
	//当前页面书
	private $currentpage;

	public function __construct($category="all",$pagesize=30){
		$this->category=$category;
		switch ($category)
		{
		case "no_deal":
			$this->filter="msg_status=0 and msg_status!=9";
			break;
		case "dealed":
			$this->filter="msg_status=1 or msg_status=2 or msg_status=3 and msg_status!=9";
			break;
		case "right":
			$this->filter="msg_status=1 and msg_status!=9";
			break;
		case "wrong":
			$this->filter="msg_status=3 and msg_status!=9";
			break;
		case "repeat":
			$this->filter="msg_status=2 and msg_status!=9";
			break;
		case "deled":
			$this->filter="msg_status=9";
			break;
		default:
			$this->filter="msg_status !=9";
			break;

		}
		$this->pagesize=$pagesize;
	}

	public function gettotalsize(){
		global $mysql;
		$mysql->setQuery("select count(id) from ims_message where $this->filter");
        $totalsize=$mysql->getOne();
		$this->totalsize=$totalsize[0];
		return $this->totalsize;
	}

	//获取内容列表,二维数组
	public function getlist($key,$page=1){
		$this->currentpage=$page;//当前显示的页面序列
		$keys=implode(",",$key);
		$page=$page-1;
		$sql="select $keys from ims_message where $this->filter order by id DESC limit ".$page*$this->pagesize.", ".$this->pagesize;
		global $mysql;
		$mysql->setQuery($sql);
		return $mysql->getRows();
	}

	//显示分页
	public function showpageinfo(){
		//获取指定条件信息总数
		$recordtotal=$this->gettotalsize();
		//页面数量
		$pagecount=ceil($recordtotal/$this->pagesize);
		$pageinfo="共".$pagecount."页/ ".$recordtotal."条记录&nbsp;&nbsp;";	

		$nextpage=$this->currentpage+1;
		$prepage=$this->currentpage-1;

		$homepage=($this->currentpage==1)?"首页":"<a href=\"?query=$this->category&page=1\">首页</a>";
		//当前页面不是最后一页的情况，都需要显示下一页
		$homepage=($this->currentpage==$pagecount)?$homepage." 下一页 ":$homepage." <a href=\"?query=$this->category&page=$nextpage\">下一页</a> ";

		$lastpage=($this->currentpage==$pagecount)?"尾页":"<a href=\"?query=$this->category&page=$pagecount\">尾页</a>";
		//当尾页不是第一页的情况下，都需要显示上一页
		$lastpage=($this->currentpage==1)?"上一页 ".$lastpage:"<a href=\"?query=$this->category&page=$prepage\">上一页</a> ".$lastpage;


		//下拉框翻页的处理
		$pagen=" <select onchange=\"window.location=this.options[this.selectedIndex].value;\">";
		for($i=1;$i<=$pagecount;$i++){
			if($i==$this->currentpage){
				$selected="selected=\"selected\"";
			}else{
				$selected="";
			}
			$pagen.="<option value=\"?query=$this->category&page=$i\"".$selected.">第".$i."页</option>";
		}
		$pageinfo=$pageinfo.$homepage.$lastpage.$pagen."</select>";
		return $pageinfo;
	}

	//获取信息详情
	public function getDetail($id){
		$id=(int)$id;
		//写入访问日志
		global $accesslog;
		$accesslog->setlog("查看信息:ID=".$id);

		//获取数据
		global $mysql;
		$mysql->setQuery("select id,name,email,tel,message,company,product,country,url,lang,team,subtime,msg_status,deal_person,deal_time,ip_add,http_referer from ims_message where id=\"$id\" and msg_status!=9");
        $res=$mysql->getRows();
		$resulte=$res[0];
		//如果信息不存在的情况
		if(empty($resulte)){
			return;
		}
		//对需要对信息进行中文解析的进行转码
		//信息状态
		switch($resulte["msg_status"]){
		case 0:
			$resulte["msg_status"]="未处理";
			break;
		case 1:
			$resulte["msg_status"]="有效";
			break;
		case 2:
			$resulte["msg_status"]="重复";
			break;
		case 3:
			$resulte["msg_status"]="无效";
			break;
		case 9:
			$resulte["msg_status"]="已删除";
			break;
		}
		//处理人
		if($resulte["deal_person"]=="") $resulte["deal_person"]="无";
		//前台提示语言
		switch($resulte["lang"]){
		case "en":
			$resulte["lang"]="英语";
			break;
		case "es":
			$resulte["lang"]="西班牙语";
			break;
		case "pt":
			$resulte["lang"]="葡萄牙语";
			break;
		case "ru":
			$resulte["lang"]="俄语";
			break;
		case "fr":
			$resulte["lang"]="法语";
			break;
		case "ar":
			$resulte["lang"]="阿拉伯语";
			break;
		case "vn":
			$resulte["lang"]="越南语";
			break;
		case "mn":
			$resulte["lang"]="蒙古语";
			break;
		case "id":
			$resulte["lang"]="印度尼西亚语";
			break;
		default:
			$resulte["lang"]="未知,语言代码:".$resulte["lang"];
			break;
		}
		return $resulte;
	}


	//标记信息
	public function markmsg($action,$id){
		$id=(int)$id;
		switch ($action){
			case "right":
				$action=1;
				break;
			case "repeat":
				$action=2;
				break;
			case "wrong":
				$action=3;
				break;
			case "del":
				$action=9;
				break;
			default:
				$action=1;
		}
		global $mysql;
		//判断信息是否存在
		$mysql->setQuery("select msg_status from ims_message where id=$id");
        $status=$mysql->getOne();
		$msg_status=$status[0];
		//对消息是否处理，存在的状态作出判断
		if($msg_status==""){
			return "非法操作，信息不存在!";
		}else if($action==9&&$msg_status==9){
			return "此条消息已经被删除，请不要重复处理!";
		}else if($action!=9&&$msg_status>0){
			return "此条消息已经处理过，请不要重复处理!";
		}
		//当消息存在而且能够处理的情况下
		//获取当前处理人员
		$u=$_SESSION["uname"];
		$mysql->setQuery("select nickname from ims_user where username=\"$u\" limit 0,1");
        $person=$mysql->getOne();
		$deal_person=$person[0];
		//更新消息状态，标记为相应的状态
		$mysql->setQuery("update ims_message set msg_status=\"$action\",deal_person=\"$deal_person\",deal_time=now() where id=$id");
		$mysql->query();
		if(mysql_error()){
			return "未知错误，处理失败!";
		}else{
			global $accesslog;
			$markaction[1]="有效";
			$markaction[2]="重复";
			$markaction[3]="无效";
			$markaction[9]="已删除";
			$accesslog->setlog("标记信息:ID=".$id."->状态为:".$markaction[$action]);
			return "处理成功!";
		}
	}

	//彻底删除或恢复信息
	public function spam_mange($id,$action){
		$id=(int)$id;
		global $mysql;
		global $accesslog;
		if($action=="del"){
			$mysql->setQuery("delete from ims_message where id=\"$id\"");
			$mysql->query();
			$accesslog->setlog("彻底删除信息:ID=".$id);
		}else{
			$mysql->setQuery("update ims_message set msg_status=0 where id=\"$id\"");
			$mysql->query();
			$accesslog->setlog("恢复信息:ID=".$id);
		}
	}
}
?>
