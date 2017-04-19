<?php
require_once("base.php");
session_start();
$username="register-username";
$nickname="register-nickname";
$password="register-password";
if(isset($_POST[$username])&&isset($_POST[$password])&&isset($_POST[$nickname]))
{
	$user=$_POST[$username];
	$nickname_=$_POST[$nickname];
	$psw=$_POST[$password];
	$sql="select username from userInfo where username='$user'";//查看用户名是否存在
	$login_db=new dbConnect();
	$login_db->dbSqlExecute($sql);
	if($login_db->dbGetFlag()==1)
		echo  "该用户名已存在.";
	else
	{
		$sql="select nickname from userInfo where nickname='$nickname_'";//查看昵称是否存在
		$login_db->dbSqlExecute($sql);
		if($login_db->dbGetFlag()==1)
			echo  "该昵称已存在.";
		else
		{
			$sql="insert into userInfo(username,nickname,password) values('$user','$nickname_',password('$psw'))";
			$login_db->dbSqlExecute_($sql);
			if($login_db->dbGetFlag()==-1)
				echo  "注册失败.";
			else
			{ 
				$_SESSION["nickname"]=$nickname_;
				$_SESSION['username']=$user;
				echo "success";//打开新页面
			}
		}
	}
}
?>