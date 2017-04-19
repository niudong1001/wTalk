<?php
if(isset($_COOKIE['nickname']))
 $k=$_COOKIE['nickname'];
if(isset($_COOKIE['username']))
 $m=$_COOKIE['username'];
if(!isset($m))
	$m="空";
if(!isset($k))
	$k="空";
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/public.css" rel="stylesheet"></link>
<link href="../css/main.css" rel="stylesheet"></link>
</head>
</head>
<body>
<div class="margin-top-35 margin-left-10 align-center center-main">
您的个人信息如下:
<div class="" id="personalInfo">
<div class="color-gray-1 margin-top-10">用户名:<?php echo $m;?></div>
<div class="color-gray-1 margin-top-10">昵称:<?php echo $k;?></div>
</div>
</div>
</body>