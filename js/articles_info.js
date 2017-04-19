/***************************评论按钮***************************************/
var nickname=idInitial("nickname");
var nickname_=getCookie("nickname");
if(nickname_!="")
	nickname.innerText=nickname_;
function show(name)
{
	alert(name);
	location.reload();
}
var comment_submit=idInitial("comment-submit");
var comment=idInitial("comment-text");
comment_submit.onclick=function()
{
	var currentServiceAliasName=getCookie("nickname");
	if(currentServiceAliasName=="")
		alertLogin();
	else
	{
		if(checkInput_()){
		var temp={"article_id":article_id,"comment":comment.value,"nickname":currentServiceAliasName};
		var ajax_info=ajax_simple_1("php/commentDispose.php",temp,1,show);
		ajax_info.submit();}
		/*
		var data_ids=Array("comment");
		var k=ajax(data_ids,"php/commentDispose.php","comment","success","articles_info.php",1);
		k.submitClick();*/
	}
}
function checkInput_()
{
	if(comment.value=="")
	{
		alert("评论不可为空!");
		return false;
	}
	return true;
}
/***************************评论按钮***************************************/