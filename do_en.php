<?php
	include "lib/header.php";

	date_default_timezone_set('Asia/Shanghai');
	$showtime=date("Y-m-d");

	$formPostData = array(
		'authType'	=>	$_POST['authtype'],
		'validDate'	=>	$_POST['valid_dt'],
		'videoName'	=>	$_POST['titlecn'],
		'authPurpose'=> $_POST['purpose'],
		'authFormat'=> $_POST['format']
	);
	//print_r($formPostData['videoName']);
	//print_r($formPostData['authFormat']);
	//exit;
	$dateArray = explode('-',$showtime);
	$dataYear = substr($dateArray[0], 2, 2);

	$sql = "SELECT `id` FROM `video` WHERE title_cn='{$formPostData['videoName']}'";
	$result = mysql_query($sql);
	$result_row = mysql_fetch_row($result);
	$videoId = $result_row[0];

	$videoName = glob('video/'.$videoId.'.*');
	$validPath = '/var/www/chvec_auth/'.$videoName[0];


	$sql = "SELECT COUNT(*) FROM `authen`";
	$result = mysql_query($sql);
	$result_row = mysql_fetch_row($result);
	
	$validCode = 'EN'.$dataYear.$dateArray[1].$formPostData['authType'].sprintf("%05d", $result_row[0]+1);

	$sql = "INSERT INTO `authen` (`type`, `code`, `valid_dt`,`purpose`,`video_id`,`title_cn`) VALUES ('{$formPostData['authType']}', '$validCode', '{$formPostData['validDate']}','{$formPostData['authPurpose']}','$videoId','{$formPostData['videoName']}')";
	if (!mysql_query($sql)) {
		die('Could not insert data' . mysql_error());
	}
	$format=$formPostData['authFormat'];

	$sql = "SELECT `id` FROM `authen` WHERE code='$validCode'";
	$result = mysql_query($sql);
	$result_row = mysql_fetch_row($result);
	$authId = $result_row[0];

	//print_r($validCode);
	//print_r($formPostData['validDate']);
	//print_r($formPostData['authPurpose']);
	//print_r($validPath);
    	//print_r($format);
    	//print_r("$validCode" . '.'."$format");
        //echo "<br/>";
	//print_r($videoId);
	//print_r($authId);
	//exit; 

	exec("/var/www/chvec_auth/all_en.sh $validCode {$formPostData['validDate']} $authId '{$formPostData['authPurpose']}' $validPath {$formPostData['authFormat']} > /dev/null & ");
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
	<h1 style="font-size:22.5px">ChinaVEC 微视频授权拷贝生成器 VideoAuth 1.0.1
</h1>
	<div class="authInfo">
		<p>
			您所授权的视频：<?php echo $validPath;?>&nbsp;&nbsp;&nbsp;视频总时长：<?php echo $videoDur.'s';?>
		</p>
		<p>
			授权号：<?php echo $validCode;?>
		</p>
		<p>
			视频有效期：<?php echo $formPostData['validDate'];?>
		</p>
		
	</div>
	<!--a id="backToIndex" class="btn btn-primary">返回</a-->
	<a id="authButton" class="btn btn-danger"><img src="img/loading.gif" width="12" style="margin-right:5px;" />正在授权</a>
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
				'fileName'	: "<?php echo "$validCode" . '.' . "$format";?>"
			},
			function (data) {
				if (data == "") {
					clearInterval(Timer1);
					setTimeout(function () {
						$("#authButton").removeClass('btn-danger')
										.addClass('btn-success').html('点击下载')
										.attr('href', 'fdown.php?name=' + "<?php echo $validCode;?>" + '.' + "<?php echo $format;?>");
						$("#backToIndex").attr('href', 'index.php');
						$('<a />').addClass("btn btn-primary")
									.attr('href', 'index_en.php').text('返回')
									.appendTo(".authBody");
					}, 10000);
				};
			}
		);
	}, 15000);
});
</script>
<?php include 'lib/footer.php'; ?>
