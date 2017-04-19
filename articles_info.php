<?php
require_once("php/base.php");

if(isset($_COOKIE['article_id']))
	$article_id=$_COOKIE['article_id'];
if(isset($_GET['primary_key']))
{
	$article_id=$_GET['primary_key'];
	setcookie("article_id",$article_id,time()+3600);
}
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/public.css" rel="stylesheet"></link>
<link href="css/main.css" rel="stylesheet"></link>
</head>
<body class="bg-color-gray">
<?php require_once('header.php');?>
<?php
$db=new dbConnect();
$sql="select comment_num,article_name,article_author_nickname,article_content,article_time from articles where article_id='$article_id'";
$db->dbSqlExecute($sql);
$result=$db->dbGetRows();
$article_name=$result[0]['article_name'];
$author=$result[0]['article_author_nickname'];
$content=$result[0]['article_content'];
$time=$result[0]['article_time'];
$comment_num=$result[0]['comment_num'];
?>
<div class="position-rel center-width margin-top-10">
<div id="article_title" class="bg-color-white position-rel">
<div class="article_title_content position-rel font-bold font-size-18">
<?php echo $article_name;?>
</div>
<span class="position-rel article_title_time color-gray-1 font-size-12">发表时间: <span class="color-gray-2"><?php echo $time;?></span></span>
<span class="position-rel article_title_author color-gray-1 font-size-12">作者: <span class="color-gray-2"><?php echo $author;?></span></span>
<span class="position-rel article_title_author color-gray-1 font-size-12">评论: <span class="color-gray-2"><?php echo $comment_num;?></span></span>
</div>
<div class="position-rel bg-color-white" id="article_content">
<div class="article_content color-gray-1 font-size-14">
<span class="color-blue-1">#文章主体#</span><br/><br/>
<?php echo $content;?></div>
</div>

<div class="position-rel bg-color-white" id="article_to_comment">
<div class="article_content"><div class="font-size-16">快速回复</div>
<span id="comment-header" class="align-center"><img src="images/namePic.png"/></br/><span class="font-size-14 color-blue-1" id="nickname">匿名</span></span>
<span id="comment-window"><textarea id="comment-text" placeholder="在此输入内容/字数小于300" maxlength='300' class="font-size-14 font-family-1 border-1"></textarea></span>
<div id="comment-submit" class="border-radius cursor-pointer">发表评论</div>
</div>
</div>

<div class="position-rel bg-color-gray-1 color-white align-center" id="comments-header">全部回贴(<?php echo $comment_num;?>)</div>
<?php
$property=array("comment_author_nickname","comment_content","comment_time");
$class_=array("comment_author_nickname","comment_content","comment_time");
$container_id="result_div_comment";
$class_for_infoRow="comment_for_infoRow";
$class_for_button="comment_for_button";
$page=new page();
$href_flag=array(0,0,0);
$href=array(0,0,0);
$page->pageStyleSet(0,$property,$class_,$container_id,$class_for_infoRow,$class_for_button);
$page->pageSet("articles_info.php",$href_flag,$href,"comment_id");
$sql="select comment_author_nickname,comment_content,comment_time from comments where   
comment_to_id='$article_id' order by comment_id desc";
$page->pageDisplay($sql,10);
?>
</div>
<footer class="position-rel center-width align-center" id="comment-footer">
<span class="color-white align-center">
powered by niudong <br/>
2016/4/6</span>
</footer>
<script>
var article_id=<?php echo $article_id;?>;
</script>
<script src="js/base.js"></script>
<script src="js/articles_info.js">
</script>
</body>
</html>