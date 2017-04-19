<?php
require_once("base.php");
 if(isset($_POST['article_id']));
	$article_id=$_POST['article_id'];
 if(isset($_POST['comment']))
	 $comment=$_POST['comment'];
  if(isset($_POST['nickname']))
	 $nickname=$_POST['nickname'];
 $time = date('y-m-d H:i:s',time());
 $sql="insert into comments(comment_to_id,comment_author_nickname,comment_content,comment_time) values('$article_id','$nickname','$comment','$time')";
 $sql1="update articles set comment_num=comment_num+1 where article_id='$article_id'";
 $db=new dbConnect();
 $db->dbSqlExecute_($sql);
 $db->dbSqlExecute_($sql1);
 if($db->dbGetFlag()!=-1)
	echo "success";
 else
	echo "failed";
?>
