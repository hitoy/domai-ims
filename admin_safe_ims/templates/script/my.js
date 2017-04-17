/*myquery库 杨海涛 2013年12月2日
*/
var $=myquery=(function(){
	//DOM Ready
	var ready=function(callback){
		if(document.addEventListener){
			document.addEventListener("DOMContentLoaded",function(){
				document.removeEventListener("DOMContentLoaded",arguments.callee,false);
				callback();
			},false)
		}else if(document.attachEvent){
			document.attachEvent("onreadystatechange",function(){
				if ( document.readyState === "complete" ) {
					document.detachEvent( "onreadystatechange", arguments.callee );
					callback();
				}
			})
		}
	}

    var notification=function(title,content,closetime,closecallback){
        if(!window.Notification){alert('您的系统不支持实时通知!');return false}
        Notification.requestPermission(function(permission){
            var config={
                body:content,
                icon:'./templates/image/notification.png',
                dir:'auto'
            }
            thisnotification=new Notification(title,config);
            thisnotification.onclose=closecallback;
            setTimeout(function(){
                thisnotification.close();
            },closetime);
        })
    }
	//显示子菜单
	var submenushow=function(id){
		var obj=document.getElementById(id);
		obj.style.display="block";
		return this;
	}
	//快捷操作菜单隐藏
	var submenuhide=function(e,obj){
		function stopBubble(e){
			if (e && e.stopPropagation) {//非IE浏览器  
				　e.stopPropagation();    
			}    
			else {//IE浏览器
				window.event.cancelBubble = true;   
			}   
		}
		var e=e||window.event;//事件兼容
		var target=e.relatedTarget||e.toElement;//获取鼠标离开时，所在的对象
		if(obj==target||obj.contains(target)){	//如果鼠标在父元素当中，则退出函数
			stopBubble(e);
			return;
		}
		obj.style.display="none";
		return this;
	}
	var selectnav=function(obj,classname){
		var siblings=obj.parentNode.childNodes;
		for (var i=0;i<siblings.length;i++){
			siblings[i].className="";
		}
		obj.className=classname;
		return this;	
	}
	//作者信息
	var showauthor=function(){
		var author=document.getElementById("author");
		if(author){
			author.innerHTML="";
			author.innerHTML=String.fromCharCode(25216,26415,25903,25345,32,60,97,32,104,114,101,102,61,34,104,116,116,112,58,47,47,119,119,119,46,104,105,116,111,121,46,111,114,103,34,32,114,101,108,61,34,97,117,116,104,111,114,34,32,116,97,114,103,101,116,61,34,95,98,108,97,110,107,34,62,26472,28023,28059,60,47,97,62);
		}else{
			alert("The Author information has been removed by some body, Please Add it on!");	
		}
		return this;
	}
	//设置cookie
	var setcookie=function(name,value,expired,path,domain){
		var now=new Date();
		if(name==null){
			throw "Cookie Name Must not be Null";
		}else if (value==null){
			throw "Cookie Value Must not be Null";
		}else if(expired==null){
			expired=0;
		}
		if(path==null){
			path="/";
		}
		if(domain==null){
			domain=window.location.host;
		}
		now.setTime(now.getTime()+expired*1000);
		document.cookie=name+"="+escape(value)+";expires="+now.toGMTString()+";path="+path+";domain="+domain;
	}
	//获取cookie
	var getcookie= function(name){
		var allcookie=document.cookie;
		thiscookie=allcookie.match(name+"=[^\\s]*");
		mycookie=thiscookie[0].split("=");
		a=mycookie[1].substring(0,mycookie[1].length);
		return unescape(a);
	}
	//生成随机密码
	var getpasswd=function(len){
		var secret="abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ&%#@";
		var selen=secret.length-1;
		var i=0;
		var password="";
		while(i<len){
			password+=secret[Math.round(Math.random()*selen)];
			i++;	
		}
		return password;
	}
	//获取本地时间
	var nowtime=(function(){
		var now=new Date();
		var year=now.getFullYear();
		var month=now.getMonth()+1;
		var date=now.getDate();
		var hour=now.getHours();
		var minute=now.getMinutes();
		var second=now.getSeconds();

		function fullshow(str){
			if(str<10){
				str="0"+str;
			}
			return str;
		}
		return year+"-"+fullshow(month)+"-"+fullshow(date)+" "+fullshow(hour)+":"+fullshow(minute)+":"+fullshow(second);
	})();
	//返回对象
	return {
		ready:ready,
			submenushow:submenushow,
			submenuhide:submenuhide,
			selectnav:selectnav,
			showauthor:showauthor,
			nowtime:nowtime,
			setcookie:setcookie,
			getcookie:getcookie,
			getpasswd:getpasswd,
            notification:notification
	}
})()
