<?php
	include "lib/header.php";

	$formPostData = array(
		'authType'	=>	$_POST['authtype'],
		'validDate'	=>	$_POST['valid_dt'],
		'videoPath'	=>	$_POST['videopath']
	);

	$dateArray = explode('-', $formPostData['validDate']);
	$dataYear = substr($dateArray[0], 2, 2);

	$sql = "SELECT COUNT(*) FROM `authfile`";
	$result = mysql_query($sql);
	$result_row = mysql_fetch_row($result);
	
	$validCode = 'C'.$dataYear.$dateArray[1].$formPostData['authType'].sprintf("%05d", $result_row[0]+1);

	$sql = "INSERT INTO `authfile` (`type`, `code`, `valid_dt`) VALUES ('{$formPostData['authType']}', '$validCode', '{$formPostData['validDate']}')";
	if (!mysql_query($sql)) {
		die('Could not insert data' . mysql_error());
	}

	exec("/var/www/ui_auth/all.sh $validCode {$formPostData['validDate']} {$formPostData['videoPath']} > /dev/null & ");
?>
<style type="text/css">
	.authBody p {
		font-family:Microsoft Hei;
	}
	.authInfo {
		margin-top:81px;
	}
	.authBody a {
		position: absolute;
		right: 273px;
		bottom: 121px;
	}
	#authButton {
		right: 441px;
		bottom: 121px;
	}
</style>
<div align="center">
	<img src="img/logo2.jpg" />
</div>
<div class="authBody" style="position:relative;">
	<h1>微视频授权系统</h1>
	<div class="authInfo">
		<p>
			您所授权的视频：<?php echo $formPostData['videoPath'];?>
		</p>
		<p>
			授权号：<?php echo $validCode;?>
		</p>
		<p>
			视频有效期：<?php echo $formPostData['validDate'];?>
		</p>
	</div>
	<!--a id="backToIndex" class="btn btn-primary">返回</a-->
	<a id="authButton" class="btn btn-danger"><img src="img/loading.gif" width="15" style="margin-right:5px;" />正在授权</a>
</div>
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">
jQuery(function($){
	var Timer1 = setInterval(function(){
		$.post(
			'file_exist.php',
			{
				'fileName'	: "<?php echo $validCode;?>" 
			},
			function (data) {
				if (data) {
					clearInterval(Timer1);
					setTimeout(function () {
						$("#authButton").removeClass('btn-danger')
										.addClass('btn-success').html('点击下载')
										.attr('href', 'fdown.php?name=' + "<?php echo $validCode;?>");
						$("#backToIndex").attr('href', 'index.php');
						$('<a />').addClass("btn btn-primary")
									.attr('href', 'index.php').text('返回')
									.appendTo(".authBody");
					}, 10000);
				};
			}
		);
	}, 10000);
});
</script>
<?php include 'lib/footer.php'; ?>