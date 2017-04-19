<?php
require_once("base.php");
if(isset($_POST["nickname"]))
	$nickname=$_POST["nickname"];
else
	$nickname="";
if(isset($_POST["old_password"]))
	$old_password=$_POST["old_password"];
else
	$old_password="";
if(isset($_POST["new_password"]))
	$new_password=$_POST["new_password"];
else
	$new_password="";
if($nickname!=""&&$old_password!=""&&$new_password!=""){
$db=new dbConnect();
$sql="update userInfo set password=password('$new_password') where nickname='$nickname' and password=password('$old_password')";
$db->dbSqlExecute_($sql);
$flag=$db->dbGetFlag();
echo $flag;}
?>