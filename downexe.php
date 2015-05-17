<?php
	setcookie('client', 'true');
	$username =$_SESSION['user'];
	require('lib/connect.php');
	$sql="UPDATE `user` set `client` = '1' where `name` = '$username'";
	$result=mysql_query($sql);
	$file_name = 'setup.exe'; 
	$file_dir = "/var/www/chvec_auth/client/";
 
	if (!file_exists($file_dir . $file_name)) { //检查文件是否存在 
		echo "文件找不到"; 
		exit; 
	} else { 
		$fp = fopen($file_dir . $file_name,"r"); // 打开文件 
		// 输入文件标签 
		Header("Content-type: application/octet-stream"); 
		Header("Accept-Ranges: bytes"); 
		Header("Content-Length: ".filesize($file_dir . $file_name)); 
		Header("Content-Disposition: attachment; filename=" . $file_name); 
		
		$buffer = 1024;
		
		//向浏览器返回数据 
		while(!feof($fp)){ 
			echo fread($fp,$buffer);
		} 
		fclose($fp);
		exit;
	}
?> 
