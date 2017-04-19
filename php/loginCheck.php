<?php
require_once('base.php');
session_start();
$username="input-username";
$password="input-password";
$code="input-verification";
if(isset($_POST[$username])&&isset($_POST[$password])&&isset($_POST[$code]))
{
	 $user=$_POST[$username];
	 $psw=$_POST[$password];
	 $code_=$_POST[$code];
	 if($user==""||$psw=="")
		 echo "用户名或密码不可为空.";
	 else if($code_=="")
		 echo "验证码不可为空.";
	 else
	 {
		 if($code_!=$_SESSION['code'])
			 echo "验证码错误.";
		 else
		 {
			 $sql="select username,password,nickname from userInfo where username='$user' and password=password('$psw')";
			 $login_db=new dbConnect();
			 $login_db->dbSqlExecute($sql);
			 
			 if($login_db->dbGetFlag()!=1)
				 echo  "用户名或密码错误."; 
			 else
			 { 
				$temp=$login_db->dbGetRows();
				$_SESSION["nickname"]=$temp[0]['nickname'];
				$_SESSION['username']=$temp[0]['username'];
				echo "success";//打开新页面
			 }
		 }
	 }
}
	?>