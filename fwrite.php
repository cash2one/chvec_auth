<?php
include "encrypt.php";
// 设文件a.mpg已经创建，并且有权操作
// 但还是加上权限设定的语句，比较保险
// chmod(dirname(__FILE__), 0777); // 以最高操作权限操作当前目录
// 打开a.mpg文件，这里采用的是a+，也可以用a，a+为可读可写，a为只写，如果b.php不能存在则会创建它


chmod ('a.avi', 0777);
$op = 'a+';
$file = fopen('a.avi', $op); // a模式就是一种追加模式，如果是w模式则会删除之前的内容再添加
// 获取需要写入的内容
$code = 'C1310F00001';
$info = 'ChinaVEC '.$code;



$info_encrypt = encrypt($info, 'E', $code.'ChinaVEC Encryption');
echo '加密:'.encrypt($info, 'E', $code.'ChinaVEC Encryption');
echo '<br>';
echo '解密：'.encrypt($info_encrypt, 'D', $code.'ChinaVEC Encryption');

// 写入追加的内容
echo '<br>'.date("Y-m-d H:i:s");
echo " - 当前文件".__FILE__."<br>";
$str=fgets($file, 1024);
echo "读取文件".$str."<br>";
echo "正在写入文件($op)……<br>";
fwrite($file, $info_encrypt.' '.$info);
// 关闭a.mpg文件
fclose($file);
echo "写入完成……<br>";
// 销毁文件资源句柄变量
unset($file);

// http://localhost/vectest/fwrite.php

?>

