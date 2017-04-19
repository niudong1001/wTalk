var forget_password=idInitial("forget_password");
forget_password.onclick=function()
{
	alert("该功能暂未开启，请期待!");
}
 /*****************************************************登录注册页面弹出***********************/
 var bgHidden=idInitial("bgHidden");
 var login=idInitial('login');
 var login_cancel=idInitial("login-cancel");
 var register=idInitial('register');
 var register_cancel=idInitial("register-cancel");
 var login_div=idInitial("login-div");
 var register_div=idInitial("register-div");
 var register_=idInitial("register_");
 var win_=getBWH();
 var l_width=500;//登录页面高
 var l_height=330;//登录页面宽
 var r_width=500;//登录页面高
 var r_height=380;//登录页面宽
var l_left=parseInt((win_[0]-parseInt(l_width))/2);//求最终left位置
var l_top=parseInt((win_[1]-parseInt(l_height))/2)-50;//求最终top位置
var r_left=parseInt((win_[0]-parseInt(r_width))/2);//求最终left位置
var r_top=parseInt((win_[1]-parseInt(r_height))/2)-50;//求最终top位置
login.onclick=function()
{
	alertLogin();
}
register.onclick=function()
{
	bgHidden.style.display="block";
	login_div.style.display="none";
	register_div.style.display="block";
	moveElement(register_div,r_left,0,r_left,r_top,1,10);	
}
register_.onclick=function()
{
	login_div.style.display="none";
	register_div.style.display="block";
	moveElement(register_div,r_left,0,r_left,r_top,1,10);	
}
register_cancel.onclick=function()
{
	bgHidden.style.display="none";
	register_div.style.display="none";
}
login_cancel.onclick=function()
{
	bgHidden.style.display="none";
	login_div.style.display="none";
}
function alertLogin()
{
	bgHidden.style.display="block";
	register_div.style.display="none";
	login_div.style.display="block";
	moveElement(login_div,l_left,0,l_left,l_top,1,10);
}
 /*****************************************************登录注册页面弹出***********************/
function loginMove()//成功后跳转
{
	//window.location.href=window.location.href;
	location.reload();	
}
/******************************************验证用户名，密码*********************/
var v_data_login=new Array("input-username","input-password","input-verification");
var login_ajax=ajax_(v_data_login,"php/loginCheck.php","alert_login","success",loginMove,1);
var iu=idInitial("input-username");
var	ip=idInitial("input-password");
var	iv=idInitial("input-verification");
var submit_login=idInitial("login-submit");
var alert_login=idInitial("alert_login");
submit_login.onclick=function()
{
	if(inputCheck()==true)
	{
		setTimeout(login_ajax.submitClick,"100");
		return false;
	}
}
iu.onfocus=function()
{
	emptyAlert();
}
function emptyAlert()//清空警告信息
{
	alert_login.innerHTML="";
}
function inputCheck()//输入检测
{
	if(iu.value==""||ip.value==""||iv.value=="")
	{
		alert_login.innerHTML="用户名密码验证码不可为空!";
		return false;
	}
	else 
		return true;
}
/******************************************验证用户名，密码*********************/

/*******************************************************************************************************验证码点击刷新****************/
function verifactionCheck(v_id)
{
	if(!checkIdExist(v_id))return false;
	var v_=idInitial(v_id);
	v_.onclick=function()
	{
		v_.src='php/verificationCheck.php?'+Math.random();
	}
	v_.onmouseover=function()
	{
		v_.style.cursor="pointer";
	}
}
addLoadEvent(verifactionCheck("input-verification_img"));
/*******************************************************************************************************验证码点击刷新****************/

/**************************************************注册******************************************************/
var v_data_register=new Array("register-username","register-nickname","register-password");//要注册的用户名昵称与密码
var register_info=idsInitial(v_data_register);//向服务器提交信息页面
var r_password=idInitial("register-r-password");//重复密码密码
var alert_register=idInitial("alert_register");//警告信息显示
var r_submit=idInitial("register-submit");//注册提交
r_submit.onclick=function()
{
	alertDisplay("");
	setTimeout(checkInput,"100");
}
function alertDisplay(info_)//警告信息显示
{
	alert_register.innerHTML=info_;
}
function checkInput()//对输入做检查
{
	var exp_str="^([a-zA-Z0-9]){5,16}$";//只能为字母数字，长度5-16；
	var exp_china="^([\u4e00-\u9fa5]|[a-zA-Z0-9]){2,4}$";//检测昵称
	var patt=new RegExp(exp_str);
	var pattt=new RegExp(exp_china);
	var user=register_info.getIdDom("register-username").value;
	var nickname_=register_info.getIdDom("register-nickname").value;
	var psw=register_info.getIdDom("register-password").value;
	var psw_r=r_password.value;
	if(user==""||psw==""||psw_r==""||nickname_=="")
		alertDisplay("用户名昵称密码不可为空!");
	else if(psw!=psw_r)
		alertDisplay("两次密码不一致.")
	else
	{
		if(patt.test(user)&&patt.test(psw)&&pattt.test(nickname_))
		{
			var login_ajax=ajax_(v_data_register,"php/registerCheck.php","alert_register","success",loginMove,1);
			login_ajax.submitClick();
		}
		else
		{
			alertDisplay("账户名或密码或昵称不合规范!");
		}
	}	
}

/**************************************************注册******************************************************/