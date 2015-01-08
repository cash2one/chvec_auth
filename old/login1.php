<?php
session_start();
require_once("lib/connect.php");
$name=$_POST['user'];
$password=md5($_POST['password']);
if ($name && $password){
 $sql = "SELECT * FROM `user` WHERE `name`= '$name' and `password`='$password'";
 $res = mysql_query($sql);
 $rows=mysql_num_rows($res);
  if($rows){
	$_SESSION['user']=$name;
	$_SESSION['password']=$password;
   header("refresh:0;url=index.php");//跳转页面
   exit;
 }
 echo "<script language=javascript>alert('用户名密码错误');history.back();</script>";
}else {
 echo "<script language=javascript>alert('用户名密码不能为空');history.back();</script>";
}
?>
