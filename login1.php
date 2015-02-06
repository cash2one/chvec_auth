<?php
session_start();
require_once("lib/connect.php");
$name=$_POST['user'];
$password=md5($_POST['password']);
$chkcode =md5($_POST['chkcode']);
echo $name.$password;
echo $chkcode.$_SESSION['randcode1'];
//print_r($chkcode);
//echo "<br/>";
//print_r($_SESSION['randcode1']);
//exit;
if($chkcode == md5('')){
 echo "<script language=javascript>alert('验证码不能为空');history.back();</script>";
 exit;
}
if($chkcode==$_SESSION['randcode1']){
if ($name && $password ){
 $sql = "SELECT * FROM `user` WHERE `name`= '$name' and `password`='$password'";
 $res = mysql_query($sql);
// $rows= mysql_num_rows($res);
 var_dump($sql);
    var_dump($res);
    exit;
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
}else {
 echo "<script language=javascript>alert('验证码错误');history.back();</script>";
}
?>
