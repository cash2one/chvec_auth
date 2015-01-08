<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>解密系统</title>
</head>
<body>

<div align="center">
	<img src="img/logo2.jpg" />
</div>
<div class="authBody" style="position:relative;">
	<h1>微视频数字水印</h1>
	<div class="authInfo">
<?php
	include "lib/header.php";
	include "encrypt.php";
		$jvideo = $_GET['code'];
        //print_r("$jvideo");
		//exit;
		$videoName = glob('video_auth/'.$jvideo.'.*');
		//print_r($videoName);
		//exit;
		$validPath = '/var/www/ui_auth/'.$videoName[0];
	   //print_r("$videoName[0]");
		//print_r("$validPath");
		$str = "$videoName[0]";
	## 将$videoN分割成数组以提取$videoN[1]
        $videoN=explode("/",$str);
	## $videoN[1]是'授权号.后缀'
		//print_r("$videoN[1]");	
		//exit;
		$all_str=file_get_contents("$validPath");
		$mima = substr($all_str,-72,43);
//echo "密码：".$mima; //在界面上显示出来所加密的密码内容
//exit;
//echo "<br>";
	$mingwen = encrypt($mima, 'D', $videoN[1].'ChinaVEC Encryption');

if($mingwen == '')
		{
			echo '<br />'.'<br />'."此视频未加密！";
	}else
		{
			echo '<br />'.'<br />'.'此视频来自中国微视频协作与交易平台'.'<br />'.'<br />'.'密码：'.$mima.'<br />'.'<br />'.'解密：'.$mingwen;//解密
	}
?>		
	</div>
</div>

</body>
</html>
