<?php
	$ip=$_SERVER["HTTP_HOST"];
	$config['auth'] = 'http://'.$ip.'/chvec_auth/';
	$config['videoRoot'] = 'http://'.$ip.'/chvec_auth/';
	$config['video'] = 'video/';
	
	$config['root'] = 'http://'.$ip.'/chinavec/';
	
	$config['posterV'] = 'data-storage/video/poster/v/';
	$config['posterH'] = 'data-storage/video/poster/h/';
	$config['activityPhoto'] = 'img/task-photo/';

	//$config['live'] = 'portal/mobile/img/live/';
	//$config['user'] = 'portal/mobile/img/user/';
	//$config['news'] = 'portal/mobile/img/news/';
	
?>
