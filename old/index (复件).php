<?php include 'lib/header.php'; ?>
<style type="text/css">
	#authForm {
		margin-top: 50px;
	}
	#authForm p {
		font-family:Microsoft Hei;
	}
	#ui-datepicker-div .ui-datepicker-title select {
		width: 42%;
	}
</style>
<div align="center">
	<img src="img/logo2.jpg" />
</div>
<div class="authBody">
	<h1>微视频授权系统</h1>
	<form id="authForm" action="do.php" method="post" enctype="multipart/form-data">
		<p>选择授权类型：
			<select type="text" name="authtype">
				<option value="F">公益授权</option>
				<option value="P">付费授权</option>
			</select>
		</p>
		<p>
			请输入有效期：<input type="text" name="valid_dt" id="datepicker" placeholder="请选择授权时间" />
		</p>
		<p>
			选择授权视频：
			<select type="text" name="videopath">
			<?php
				$sql = "SELECT * FROM `videofile`";
				$result = mysql_query($sql);
				while ($result_row = mysql_fetch_assoc($result)) {
					echo <<<OPTION
					<option value="{$result_row['video_path']}">{$result_row['video_path']}</option>
OPTION;
				}
			?>
		    </select>
		</p>
		<button name="submit" type="submit" class="btn btn-primary">点击授权</button>
	</form>
	
</div>
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">
jQuery(function($){
	$("#datepicker").datepicker({//添加日期选择功能
		numberOfMonths:1,//显示几个月  
		showButtonPanel:true,//是否显示按钮面板 
		showWeek: true,// 显示星期
		dateFormat: 'yy-mm-dd',//日期格式   
		closeText:"关闭",//关闭选择框的按钮名称  
		yearSuffix: '年', //年
		weekHeader: '周', 
		currentText: '今天',
		changeMonth: true,
		changeYear: true,
		showMonthAfterYear:true,//是否把月放在年的后面
		//'一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'
		monthNamesShort: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],  
		dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],  
		dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'],  
		dayNamesMin: ['日','一','二','三','四','五','六'],
		onClose: function () {
			if (!$(this).val()) {
				var date = new Date();
				var year = date.getFullYear();
				var month = date.getMonth() + 1;
				month = (month.toString().length < 2) ? ('0' + month) : month;
				var day = date.getDate();
				day = (day.toString().length < 2) ? ('0' + day) : day;
				$(this).val(year+'-'+month+'-'+day);
			};
		}
	});
});
</script>
<?php include "lib/footer.php"; ?>
