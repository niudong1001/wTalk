<?php
session_start();
if(isset($_SESSION['nickname']))
	$nickname=$_SESSION['nickname'];
if(!isset($nickname))
	$nickname="";
if(isset($_SESSION['username']))
	setcookie("username",$_SESSION['username'],time()+3600);
setcookie("nickname",$nickname,time()+3600);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/public.css" rel="stylesheet"></link>
<link href="css/header.css" rel="stylesheet"></link>
<link href="css/form.css" rel="stylesheet"></link>
<div class="bg-color-white">
<div class="center-width position-rel" id="container">
<div id="logo" class="position-abs">
 <img src="images/logo.png"/>
</div>

<div id="login-register" class="position-abs">
<div id="menu" class="position-abs">
<ul id="menu-ul">
 <li><a href="index.php">首页</a></li>
  <!--<ul>
   <li><a href="#">全部类型</a></li>
  </ul>-->
 <!-- <ul>
   <li><a href="#">全部信息</a></li>
  </ul>-->
</ul>
</div>
<?php 
if($nickname=="")
{
	echo "<div id='login' class='float-right font-size-14'>登陆</div>";
	echo "<div id='register' class='float-right font-size-14'>注册</div>";
}
else
{	
	echo " <a href='php/logout.php'><div id='logout' class='float-right font-size-14'>注销</div></a>";
	echo " <a href='sendArticle.php'><div id='send' class='float-right font-size-14'>我要发帖</div></a>";
	echo " <a href='personalCenter.php'><div id='personalCenter' class='float-right font-size-14'>个人中心</div></a>";
	echo "<div id='welcome' class='float-right font-size-14'>欢迎您:<span class='color-blue'>$nickname</span></div>";	
}
?>
</div>
</div>
</div>
<!--登录页面-->
<div id="login-div" class="position-fix login-register-div">
<div class="title border-radius-top">登陆页面</div>
<div id="login-main" class="border-radius position-abs">
<span id="alert_login" class="position-abs color-red margin-top-10"></span>
<br/>
<input type="text" name="username" tabIndex="1" placeholder="用户名" class="border-radius border-1 input-button bg-color-white margin-top-15" id="input-username"></input> <span class="color-blue">
<a href="#" id="register_">用户注册</a></span>
<br/>
<input type="password" tabIndex="2" name="password" placeholder="密码" class="border-radius border-1 input-button bg-color-white margin-top-15" id="input-password"></input> <span class="color-blue">
<a href="" id="forget_password">忘记密码</a></span><br/>
<input type="text" name="verification" tabIndex="3" placeholder="验证码" class="border-radius border-1 login-input-verifi bg-color-white margin-top-15 position-abs" id="input-verification"></input>
<img alt="验证码" title="点击刷新" src="php/verificationCheck.php" id="input-verification_img">
<div id="login-submit" class="submitClikHover border-radius color-white cursor-pointer position-abs bg-color-blue login-button">登陆</div>
<div id="login-cancel" class="submitClikHover border-radius color-white cursor-pointer position-abs bg-color-blue login-button" >关闭</div>
</div>
</div>
<!--注册页面-->
<div id="register-div" class="position-fix login-register-div">
<div class="title border-radius-top">注册页面</div>
<div id="login-main" class="border-radius position-abs">
<span id="alert_register" class="position-abs color-red margin-top-10"></span>
<br/>
<span class="color-red">*</span>用户名: <input type="text" name="username" placeholder="字母|数字(5-16)" class="border-radius border-1 input-button bg-color-white margin-top-15" id="register-username"></input>
<br/>
<span class="color-red">&nbsp&nbsp&nbsp*</span>昵称: <input type="text" name="nickname" placeholder="字母|数字|汉字(2-4)" class="border-radius border-1 input-button bg-color-white margin-top-15" id="register-nickname"></input>
<br/>
<span class="color-red">&nbsp&nbsp&nbsp*</span>密码: <input type="password" name="password" placeholder="字母|数字(5-16)" class="border-radius border-1 input-button bg-color-white margin-top-15" id="register-password"></input>
<br/>
<span class="color-red">&nbsp&nbsp&nbsp*</span>密码: <input type="password" name="password" placeholder="字母|数字(5-16)" class="border-radius border-1 input-button bg-color-white margin-top-15" id="register-r-password"></input>
<br/>
<div id="register-submit" class="submitClikHover border-radius color-white cursor-pointer position-abs bg-color-blue register-button">注册</div>
<div id="register-cancel" class="submitClikHover border-radius color-white cursor-pointer position-abs bg-color-blue register-button">关闭</div>
</div>
</div>
<div id="bgHidden" class="bg-color-white">
</div>
<script src="js/base.js"></script>
<script src="js/header.js"></script>