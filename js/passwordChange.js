var old_password=idInitial("old-password");
var new_password=idInitial("new-password");
var new_password_r=idInitial("new-password-r");

var password_save=idInitial("password-save");
password_save.onclick=function()
{
	var value1=old_password.value;
	var value2=new_password.value;
	var value3=new_password_r.value;
	if(value1=="")
		alert("原密码不可为空.");
	else if(value2==""||value3=="")
		alert("新密码不可为空.");
	else
	{
		if(value2!=value3)
			alert("两次输入的密码不一样.");
		else
		{
			var nickname_=getCookie("nickname");
			var data={"nickname":nickname_,"old_password":value1,"new_password":value2};
			var ajax=ajax_simple_1("passwordChangeDispose.php",data,1,show);
			ajax.submit();
		}
	}
}
function show(num)
{
	if(num==0)
	{
		alert("原密码输入错误!");
	}
	else
	{
		alert("修改成功！");
		parent.window.location.href="logout.php";
	}
}