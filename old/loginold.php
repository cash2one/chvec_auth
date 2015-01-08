<?php include 'lib/header.php'; ?>
<style type="text/css">
	#authBody p {
		font-family:Microsoft Hei;
	}
</style>
<div align="center">
	<img src="img/logo2.jpg" />
</div>
<div class="authBody">
	<h1>微视频授权系统</h1>
	<div style=" width:750px;text-align:center;margin-top:60px">
		<form class="form-horizontal login" name="login" action="login1.php" method="post">
		<div class="control-group">
			<p>
				用户名：<input type="text" name="user" style="width:134px">
			</p>
		</div>
		<div class="control-group" >
			<p>
				密码:<input type="password" name="password" style="width:152px">
			</p>	
		</div>
		<div class="controls" style=" width:450px;text-align:center">
				<button type="submit" class="btn btn-info">登录</button>
				<button type="reset" class="btn" style="margin-left:30px">清除</button>
		</div>
    </div>
</div>    
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<?php include "lib/footer.php"; ?>
