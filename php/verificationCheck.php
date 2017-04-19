<?php
require_once("base.php");
session_start();
$code=new Vcode(50,30,4);
$code->outimg();
$_SESSION['code']=$code->getcode();
?>