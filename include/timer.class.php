<?php
/***********************************
 程序执行时间类，用来显示执行时间
 杨海涛 2013年12月18日
**********************************/
class Timer{
	private $starttime=0;	
	private $stoptime=0;
	public function __construct(){
		$this->starttime=microtime(true);
	}
	public function spend(){
		$this->stoptime=microtime(true);
		return round($this->stoptime-$this->starttime,9)*1000;
	}
}
?>
