<html>
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<input type="hidden" name="time" value="<?php echo date('Y-m-d');?>"/> </td>

<script>

$(function() {
  $("#delete").click(function() {
	var result = confirm("确定要删除过期视频吗？");
	//console.log(result);
	if(result == true){
		
	$.ajax({
		url:'delete.php',
		type:'get',
		success:function(data){
		$(".delete").css("display","block");
		$("#deletevideo").css("display","none");
		$("#warn").css("display","none");
		setTimeout("$('.delete').html('过期视频已删除'),$('.delete').css('left','42%')",6000);
		}
	});
	
	//window.location.href='delete.php';
	}
  });
})


</script>

	<div id="warn">
	<p style="margin:150px 0 0 75px;color:red;font-size:20px">警告：
	<p style="margin:-20px 0 0 0;text-align:center;padding-left:90px;font-size:20px">删除将无法恢复数据，如需删除，请按确定删除</p></p>
	</div>	
	<div id="deletevideo">
	<center>
	<button id="delete" name='submit' type='submit' class="btn btn-primary" style="margin-top:150px">确定删除</button>
	<a name='logout' type='button' class='btn' href='' style='margin-left:150px;margin-top:150px'>取消</a></center>
	</div>

	<div class="delete" id="delete" style="margin:205px auto;font-size:20px;display:none;position:absolute;left:35%"><img src="img/loading.gif" width="20" style="margin-right:5px;">正在删除过期视频，请稍候....</div>
</html>
