<?php
require_once("base.php");
 if(isset($_POST['title']));
	$title=$_POST['title'];
 if(isset($_POST['content']))
	 $content=$_POST['content'];
  if(isset($_POST['nickname']))
	 $nickname=$_POST['nickname'];
$time = date('y-m-d H:i:s',time());
 $class=3;
 $sql="insert into articles(article_author_nickname,article_name,article_content,article_class,article_time) values('$nickname','$title','$content','$class','$time')";
 $db=new dbConnect();
 $db->dbSqlExecute_($sql);
 if($db->dbGetFlag()!=-1)
	echo "success";
 else
	echo "failed";
?>