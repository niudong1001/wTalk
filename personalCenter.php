<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/public.css" rel="stylesheet"></link>
<link href="css/main.css" rel="stylesheet"></link>
</head>
<body class="bg-color-gray">
<?php require_once('header.php');?>
<div id="main-container" class="center-width-1 position-rel font-size-16">
<div id="center-nav" class="align-center">
<span class="font-bold font-size-18">个人中心</span>
<div class="bg-color-white margin-top-10 width-100 padding-3 font-size-15 personalNav" id="personalInfo"><img src="images/personalInfoPic.PNG"> 
<a href="php/personalInfo.php" target="info">
个人信息</a></div>
<div class="width-100 padding-3 font-size-15 personalNav" id="passwordChange"><img src="images/personalPasswordPic.PNG"> <a href="php/passwordChange.php" target="info">密码修改</a></div>
</div>
<div id="center-main">
<iframe src="php/personalInfo.php" class="iframe" name="info"></iframe>
</div>
</div>
<footer class="position-rel center-width align-center">
<span class="color-white align-center">
powered by niudong <br/>
2016/4/6</span>
</footer>
<script src="js/base.js"></script>
<script src="js/personalInfo.js"></script>
</body>
</html>