function addLoadEvent(func)//添加函数到window.onload
{
	var old_onload=window.onload;
	if(typeof window.onload!='function')
	window.onload=func;
	else
	{
		window.onload=function()
		{
			old_onload();
			func();
		}
	}
}
function test()
{
	alert("test!");
}
function checkJsSupport()//查看js命令是否被浏览器支持
{
	if(!document.getElementById)return false;
	if(!document.getElementsByTagName)return false;
	return true;
}
function checkIdExist(html_id)//查看HTMLid是否存在 
{
	if(!document.getElementById(html_id))return false;
	return true;
}
function checkClassExist(html_class)
{
	if(!document.getElementsByClassName(html_class))return false;
	return true;
}
/**********************************************frame自适应****/
function reinitIframe(frame_name)
{
	var iframe=idInitial(frame_name);
	try{
		var bHeight=iframe.contentWindow.document.body.scrollHeight;
		var dHeight=iframe.contentWindow.document.documentElement.scrollHeight;
		var height = Math.max(bHeight, dHeight);
		iframe.height=height;
	}catch (ex){}
}
/**********************************************frame自适应****/
/*********************************************nav元素点击****************************************************/
function navClick(father_id,child_id,initial_tag,changeToBgColor,originalBgColor)//nav点击类
{
	//initial_tag为index
	var nav=new Object();
	nav.father=idInitial(father_id);//父元素
	nav.childs=nav.father.getElementsByTagName(child_id);//获得子元素
	nav.now_child=nav.childs[initial_tag];
	nav.changeBg=function(){this.now_child.style.backgroundColor=changeToBgColor;}//改变背景
	nav.returnBg=function(){this.now_child.style.backgroundColor="";}
	nav.equalClick=function(num){this.returnBg();this.now_child=this.childs[num];this.changeBg();}
	return nav;
}
/*********************************************nav元素点击****************************************************/
/*******************************************************元素移动***************************/
function moveElement(elem,origin_x,origin_y,final_x,final_y,flag,interval)//移动元素函数,flg为判断是否从origin处开始移动(1:yes,0:no)
{
	if(flag==1)//是否从origin开始移动
	{
		elem.style.top=origin_y+"px";
		elem.style.left=origin_x+"px";
	}
	if(elem.movement)clearTimeout(elem.movement);
	var xpos=parseInt(elem.style.left);
	var ypos=parseInt(elem.style.top);
	var dist=0;//每次移动的距离
	if(xpos==final_x&&ypos==final_y)
		return true;
	if(xpos<final_x)
	{
		dist=Math.ceil((final_x-xpos)/10);
		xpos=xpos+dist;
	}
	if(xpos>final_x)
	{
		dist=Math.ceil((xpos-final_x)/10);
		xpos=xpos-dist;
	}
	if(ypos<final_y)
	{
		dist=Math.ceil((final_y-ypos)/10);
		ypos=ypos+dist;
	}
	if(ypos>final_y)
	{
		dist=Math.ceil((ypos-final_y)/10);
		ypos=ypos-dist;
	}
	elem.style.left=xpos+"px";
	elem.style.top=ypos+"px";
	elem.movement=setTimeout(function(){moveElement(elem,origin_x,origin_y,final_x,final_y,0,interval);},interval);
}
/*******************************************************元素移动***************************/

/*****************************************************************************dom树**************************************/
function idsInitial(ids)//DOM树id对象集
{
	var id=new Object;//id对象生成
	id.all_ids=Array();
	var len=ids.length;
	if(checkJsSupport())
	for(var i=0;i<len;i++)
		if(checkIdExist(ids[i]))
			id.all_ids[ids[i]]=document.getElementById(ids[i]);
	id.getIdDom=function(id_name)//获得id为id_name的dom对象
	{
		return this.all_ids[id_name];
	}
	id.addId=function(id_name)//增加一个dom结点(只是从本对象的存储空间删除)
	{
		if(checkIdExist(id_name))
		this.all_ids[id_name]=document.getElementById(id_name);
	}
	id.deleteId=function(id_name)//删除一个dom结点
	{
		for(var id_ in this.all_ids)
			if(id_name==id_)
				delete this.all_ids[id_];
	}
	id.showKey=function()//显示键值
	{
		for(var id_ in this.all_ids)
			alert(id_);
	}
	id.showValue=function()//显示值
	{
		for(var id_ in this.all_ids)
			alert(this.all_ids[id_]);
	}
	return id;
}
function idInitial(id_name)//单个id声明
{
	if(checkJsSupport()&&checkIdExist(id_name))
		return document.getElementById(id_name);
}
/*****************************************************************************dom树**************************************/

/*******************************************************************************************************浏览器高与宽******************/
function getBWH()//获得浏览器窗口宽高
{
	var win_width,win_height,win_;
	if(window.innerWidth)
		win_width=window.innerWidth;
	else if ((document.body) && (document.body.clientWidth))
		win_width = document.body.clientWidth;
	if (window.innerHeight)
		win_height = window.innerHeight;
	else if ((document.body) && (document.body.clientHeight))
		win_height = document.body.clientHeight;
	win_=Array(win_width,win_height);
	return win_;	//win_[0]为高,win_[1]为宽
}
/*******************************************************************************************************浏览器高与宽******************/

/**************************************************************************************ajax数据传送*******************************/
//ajax函数类
//简单ajax数据传送(action_url要提交的页面,str_要提交的数据)
//str_请用关联数组方式
function ajax_simple(action_url,str_,div_,method)
{
	var ajax_=new Object;
	ajax_.action_url=action_url;//提交服务器地点
	ajax_.postStr;//键值对
	ajax_.result;//返回结果
	div=idInitial(div_);
	ajax_.submit=function()//提交数据
	{
		
		this.createStr();
		if(method==0)
		{
			ajax_.action_url+="?";
			ajax_.action_url+=ajax_.postStr;
		}
		var xml_http=window.XMLHttpRequest?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
		if(method==1)
		xml_http.open("POST",ajax_.action_url,false);//“准备”向服务器的GetDate1.ashx发出Post请求
		else if(method==0)
		xml_http.open("GET",ajax_.action_url,false);//“准备”向服务器的GetDate1.ashx发出Post请求
		xml_http.onreadystatechange=function()
		{
			if(xml_http.readyState==4)//readyState == 4 表示服务器返回完成数据了。
			{
				this.result=xml_http.responseText;
				div.innerHTML=this.result;
			}
		}
		xml_http.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		if(method==1)
		xml_http.send(this.postStr);
		else if(method==0)
		xml_http.send(null);
	}
	ajax_.createStr=function()//键值对准备
	{
		this.postStr="";//用于存储发送的键值对
		for(var key in str_)
			this.postStr+=key+"="+str_[key]+"&";//链接键值对
		this.postStr=this.postStr.substring(0,this.postStr.length-1);//删除最后一个&
	}
	return ajax_;
}
function ajax_simple_1(action_url,str_,method,func)
{
	var ajax_=new Object;
	ajax_.action_url=action_url;//提交服务器地点
	ajax_.postStr;//键值对
	ajax_.result;//返回结果
	ajax_.func=func;
	ajax_.submit=function()//提交数据
	{
		this.createStr();
		if(method==0)
		{
			ajax_.action_url+="?";
			ajax_.action_url+=ajax_.postStr;
		}
		var xml_http=window.XMLHttpRequest?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
		if(method==1)
		xml_http.open("POST",ajax_.action_url,false);//“准备”向服务器的GetDate1.ashx发出Post请求
		else if(method==0)
		xml_http.open("GET",ajax_.action_url,false);//“准备”向服务器的GetDate1.ashx发出Post请求
		xml_http.onreadystatechange=function()
		{
			if(xml_http.readyState==4)//readyState == 4 表示服务器返回完成数据了。
			{
				func(xml_http.responseText);
			}
		}
		xml_http.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		if(method==1)
		xml_http.send(this.postStr);
		else if(method==0)
		xml_http.send(null);
	}
	ajax_.createStr=function()//键值对准备
	{
		this.postStr="";//用于存储发送的键值对
		for(var key in str_)
			this.postStr+=key+"="+str_[key]+"&";//链接键值对
		this.postStr=this.postStr.substring(0,this.postStr.length-1);//删除最后一个&
	}
	return ajax_;
}
function ajax(data_ids,action_url,alert_,judge_str,new_url,flag)
{
	var ajax_=new Object;
	ajax_.data=idsInitial(data_ids);//要验证数据id集
	ajax_.action_url=action_url;//提交服务器地点
	ajax_.info=idInitial(alert_);//返回信息显示点
	ajax_.judge_str=judge_str;//判断服务器返回成功的标识
	ajax_.new_url=new_url;//成功转到url;
	ajax_.flag=flag;//是否显示提示信息.1,0
	ajax_.postStr;//键值对
	ajax_.submitClick=function()//事件绑定
	{
		if(ajax_.flag==1)
			ajax_.info.innerHTML="";
		ajax_.validAction();
	}
	ajax_.validAction=function()//键值对准备
	{
		//var d=new Array();//用于存储键（数据名）,值(数据值)
		//var len=ajax_.data.all_ids.length;
		this.postStr="";//用于存储发送的键值对
		for(var key in ajax_.data.all_ids)
			this.postStr+=key+"="+ajax_.data.all_ids[key].value+"&";//链接键值对
		this.postStr=this.postStr.substring(0,this.postStr.length-1);//删除最后一个&
		this.ajax__();
	}
	ajax_.ajax__=function()//建立连接
	{
		var xml_http=window.XMLHttpRequest?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
		xml_http.open("POST",ajax_.action_url,true);//“准备”向服务器的GetDate1.ashx发出Post请求
		xml_http.onreadystatechange=function()
		{
			if(xml_http.readyState==4)//readyState == 4 表示服务器返回完成数据了。
			{
				var txt=xml_http.responseText;
				if(txt==ajax_.judge_str)
				{
					window.location.href=ajax_.new_url;//与成功标识相同，转到新url
					
				}
				else
				{
					if(ajax_.flag==1)
					ajax_.display(txt);
				}
			}
		}
		xml_http.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xml_http.send(this.postStr);
	}
	ajax_.display=function(txt)
	{
		ajax_.info.innerHTML=txt;
	}
	return ajax_;
}
function ajax_(data_ids,action_url,alert_,judge_str,func,flag)
{
	var ajax_=new Object;
	ajax_.data=idsInitial(data_ids);//要验证数据id集
	ajax_.action_url=action_url;//提交服务器地点
	ajax_.info=idInitial(alert_);//返回信息显示点
	ajax_.judge_str=judge_str;//判断服务器返回成功的标识
	ajax_.func=func;//成功转到url;
	ajax_.flag=flag;//是否显示提示信息.1,0
	ajax_.postStr;//键值对
	ajax_.submitClick=function()//事件绑定
	{
		if(ajax_.flag==1)
			ajax_.info.innerHTML="";
		ajax_.validAction();
	}
	ajax_.validAction=function()//键值对准备
	{
		//var d=new Array();//用于存储键（数据名）,值(数据值)
		//var len=ajax_.data.all_ids.length;
		this.postStr="";//用于存储发送的键值对
		for(var key in ajax_.data.all_ids)
			this.postStr+=key+"="+ajax_.data.all_ids[key].value+"&";//链接键值对
		this.postStr=this.postStr.substring(0,this.postStr.length-1);//删除最后一个&
		this.ajax__();
	}
	ajax_.ajax__=function()//建立连接
	{
		var xml_http=window.XMLHttpRequest?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
		xml_http.open("POST",ajax_.action_url,true);//“准备”向服务器的GetDate1.ashx发出Post请求
		xml_http.onreadystatechange=function()
		{
			if(xml_http.readyState==4)//readyState == 4 表示服务器返回完成数据了。
			{
				var txt=xml_http.responseText;
				if(txt==ajax_.judge_str)
				{
					
					ajax_.func();
				}
				else
				{
					if(ajax_.flag==1)
					ajax_.display(txt);
				}
			}
		}
		xml_http.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xml_http.send(this.postStr);
	}
	ajax_.display=function(txt)
	{
		ajax_.info.innerHTML=txt;
	}
	return ajax_;
}
/**************************************************************************************ajax数据传送*******************************/

/********************************************************************************寻找父元素下一元素的index*************************/
function setCookie(c_name,value,expiredays)
{
var exdate=new Date()
exdate.setDate(exdate.getDate()+expiredays)
document.cookie=c_name+ "=" +escape(value)+
((expiredays==null) ? "" : ";expires="+exdate.toGMTString())
}
function getCookie(c_name)
{
if (document.cookie.length>0)
  {
  c_start=document.cookie.indexOf(c_name + "=")
  if (c_start!=-1)
    { 
    c_start=c_start + c_name.length+1 
    c_end=document.cookie.indexOf(";",c_start)
    if (c_end==-1) c_end=document.cookie.length
    return decodeURI(document.cookie.substring(c_start,c_end))
    } 
  }
return ""
}