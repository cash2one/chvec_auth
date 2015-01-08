<?php include 'lib/header.php'; ?>
<a id="authButton" class="btn btn-danger">正在授权</a>
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">
jQuery(function($){
	var Timer1 = setInterval(function(){
		$.post(
			'file_exist.php',
			{
				'fileName'	: "<?php echo '$validCode';?>" 
			},
			function (data) {
				if (data) {
					clearInterval(Timer1);
					$("#authButton").removeClass('btn-danger')
									.addClass('btn-success').text('点击下载')
									.click(function () {
										$(this).attr('href', 'fdown.php?name=' + "<?php echo '$validCode';?>");
									});
				};
			}
		);
	}, 10000);
});
</script>
<?php include 'lib/footer.php'; ?>