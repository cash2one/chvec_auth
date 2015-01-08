<?php
session_start();
?>
<?php include 'lib/header.php';
	include 'config/config.php'; ?>
<style type="text/css">
	#authBody p {
		font-family:Microsoft Hei;
	}
</style>
<div align="center">
	<img src="<?php echo $config['videoRoot'] ?>img/vec_logo1.jpg" />
</div>
<div class="authBody">
	<h1 style="margin-top:0px;margin-bottom:0px;">微视频授权系统</h1>
	<div style="width:750px;text-align:center;margin:60px auto;">
		<form class="form-horizontal login" name="login" action="login1.php" method="post">
		<div class="control-group">
			<p>
				用户名：<input type="text" name="user" style="width:134px">
			</p>
		</div>
		<div class="control-group" >
			<p>
				密&nbsp;&nbsp;&nbsp;&nbsp;码：<input type="password" name="password" style="width:134px">
			</p>
		</div>
		<div style="margin-left:83px;">验证码：<input  style="width:134px;margin-top:0px;" type="text" name="chkcode" id="chkcode" class="" value="" placeholder="验证码" onBlur="checkchkcode()"/></td>
					<td><a href="javascript:reloadcode_login();"><img src="code.php" id="chkimg"></a></td><td id="hint_chkcode" style="color:red;"></td></tr>	
		</div>
		<div class="controls" style="margin-top:20px; width:450px;text-align:center;*padding-left:70px;">
				<button type="submit" class="btn btn-info">登录</button>
				<button type="reset" class="btn" style="margin-left:30px">清除</button>
		</div>
    </div>
</div>    
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/login-js.js"></script> 
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<?php include "lib/footer.php"; ?>
