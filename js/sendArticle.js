var data_send=new Array("sendTitle","editor");//要注册的用户名昵称与密码
var dd=idsInitial(data_send);
var sendAlert=idInitial(sendAlert);
var submit_=idInitial("sendSubmit");
var currentServiceAliasName=getCookie("nickname");
var class__=idInitial("article_class_");
var article_source=idInitial("article_source");
var choice="首发";
class__.onclick=function()
{
	if(class__.value=="首发")
	{
		article_source.style.display="none";
		
	}
	else
	{
		article_source.style.display="inline-block";

	}

	
}
submit_.onclick=function()
{
	if(currentServiceAliasName=="no")
		alertLogin();
	else
	{
		if(checkInput())
		{
			choice=class__.value;
			if(choice!="首发")
			{
				var content_class=article_source.value;
				if(content_class=="")
					alert("请输入文章来源.");
				else
					choice+=content_class;
			}
			if(choice=="首发"||choice!="首发"&&content_class!="")
			{
				var title=dd.getIdDom("sendTitle").value;
				var content="文章来源:"+choice+"   "+dd.getIdDom("editor").value;
				var temp={"title":title,"content":content,"nickname":currentServiceAliasName};
				var ajax_info=ajax_simple_1("php/createArticle.php",temp,1,show);
				ajax_info.submit();
			}
		}
	}
}
function checkInput()//对输入做检查
{
	if(dd.getIdDom("sendTitle").value=="")
		alert("标题不可为空!");
	else
	{
		if(dd.getIdDom("editor").value=="")
			alert("内容不可为空!");
		else
		{
				return true;
		}
	}
}
function show(name)
{
	window.location.href="successSend.php";
}