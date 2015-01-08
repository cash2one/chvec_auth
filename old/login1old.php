<?php
require_once("lib/connect.php");
$name=$_POST['user'];
$passowrd=$_POST['password'];
if ($name && $passowrd){
 $sql = "SELECT * FROM admin WHERE name= '$name' and password='$passowrd'";
 $res = mysql_query($sql);
 $rows=mysql_num_rows($res);
  if($rows){
   header("refresh:0;url=index.php");//跳转页面
   exit;
 }
 echo "<script language=javascript>alert('用户名密码错误');history.back();</script>";
}else {
 echo "<script language=javascript>alert('用户名密码不能为空');history.back();</script>";
}
?>
