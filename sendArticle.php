<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/public.css" rel="stylesheet"></link>
<link href="css/main.css" rel="stylesheet"></link>
<link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="css/simditor.css" />
</head>
<body class="bg-color-gray">
<?php require_once('header.php');?>
<div class="position-rel font-size-16 center-width">
<div id="" class="center-width-1">
<div class="margin-top-15 align-center"><div class="position-abs" id="sendAlert"></div>
<span class="color-blue">我要发帖</span><br/>
<select name="select" id="article_class_" class="font-family-1 border-1 margin-top-10">  
<option selected="selected" value="首发">首发</option>
<option value="转自">转自</option>    
</select>
<input type="text" id="article_source" class="border-1 font-family-1 bg-color-white" placeholder="文章来源" maxlength="8"></input>
<input type="text" id="sendTitle" class="border-1 margin-top-10" placeholder="请输入标题/字数小于30" maxlength='30'></input>
</div>
<div id="sendMain" class="margin-top-15 position-rel">
<textarea id="editor" placeholder="这里输入内容/字数小于600" class="align-left font-size-14" maxlength='600' autofocus></textarea>
<div class="align-center margin-top-15 font-size-14">
<div id="sendSubmit" class="border-radius color-white cursor-pointer bg-color-blue submitClikHover">发帖</div>
</div>
</div>
</div>
<footer class="position-rel align-center" id="send-footer">
<span class="color-white align-center">
powered by niudong <br/>
2016/4/6</span>
</footer>
</div>

<script type="text/javascript" src="js/js/jquery.min.js"></script>
    <script type="text/javascript" src="js/js/module.js"></script>
    <script type="text/javascript" src="js/js/uploader.js"></script>
    <script type="text/javascript" src="js/js/simditor.js"></script>
	<script type="text/javascript">
    var editor = new Simditor({
      textarea: $('#editor')
    });
  </script>
  <script src="js/base.js"></script>
  <script src="js/sendArticle.js"></script>
</body>
</html>