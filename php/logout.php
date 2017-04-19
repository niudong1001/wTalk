<?php
session_start();
if(isset($_SESSION["nickname"]))
	unset($_SESSION["nickname"]);
if(isset($_COOKIE['nickname']))
	setcookie("nickname","",time()-3600);
echo "<script>alert('注销成功');window.location.href='../index.php';</script>";
?>