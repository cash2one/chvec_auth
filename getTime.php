<?php
	$getNum = $_POST['validCode'].'.'.'txt';
	$handle = popen("python /var/www/chvec_auth/get.py /var/www/chvec_auth/progress/$getNum 2>&1", 'r');
	$buffer = fgets($handle);
	echo $buffer;
?>
