<?php
require_once('base.php');
$info_=array("论坛天地","信息发布","关于我");
if(!isset($_COOKIE["nav_num"]))
	$temp=$info_[0];
else
	$temp=$info_[$_COOKIE["nav_num"]-1];
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/public.css" rel="stylesheet"></link>
<link href="../css/main.css" rel="stylesheet"></link>
</head>
<body>
<div id="main_right_container">
<?php
//$property//查询的属性
//$class_//为每个查询出的属性值建立class
//$container_id包含所有查询结果对象的div
//$class_for_infoRow
//$class_for_button
if($temp!="关于我")
{
	$property=array("comment_num","article_name","class_name","article_author_nickname","article_time");
	$class_=array("comment_num","article_name","class_name","article_author_nickname","article_time");
	$container_id="result_div";
	$class_for_infoRow="class_for_infoRow";
	$class_for_button="class_for_button";
	$page=new page();
	$href_flag=array(0,1,0,0,0);
	$href=array(0,'../articles_info.php',0,0,0);
	$page->pageStyleSet(1,$property,$class_,$container_id,$class_for_infoRow,$class_for_button);
	$page->pageSet("main_right_forum.php",$href_flag,$href,"article_id");
	$sql="select comment_num,article_id,article_name,article_author_nickname,class_name,article_time from articles,class where article_class=class_id and class_name='$temp' order by article_id desc";
	$page->pageDisplay($sql,12);
}
else
{
?>	
<br/>
<div class="">你好，很高兴您可以浏览这个网站!<br/>如果您有一些关于这个网站的建议与意见，可以联系我。
<br/>
我的邮箱是:happy05abc@foxmail.com
</div>
<?php
}
?>
</div>
<script src="../js/base.js"></script>
<script src="../js/index_main.js"></script>
</body>
</html>