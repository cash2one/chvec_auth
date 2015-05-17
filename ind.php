<?php
	session_start();
?>
<?php include 'lib/header1.php'; ?>
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
	p
	{
		text-align:left;
		padding-left:190px;
		
	}
	#authForm
	{
		width:700px;
		margin:0 auto;

	}
</style>
<script>
$(function() {
$( "#tabs" ).tabs();
});

$(document).ready(function(){
	$("#outdated_copy").click(function(){
		$("#tabs-2").load("pre_delete.php",{out:"",id:""});
	});
});
</script>
<script type="text/javascript">
$(function(){


	$("#authtype").click(function(){

	var value =$("#authtype").val();
    	
	console.log(value);
	var playscene = $("#p_playscene").val();
	console.log(playscene);
	if(value=='P'){
	$('#p_playscene').css("display","block");
	$('#f_playscene').css("display","none");
	$('#chose-stream').css("display","none");
	$('#mark').css("display","block");
	$('#xianshi').removeAttr("disabled");
	$('#xianshi').removeAttr("checked");
	$('#copyrightmark').css("display","none");
		if(value=='P' && playscene == "cinema"){
				$('#xianshi').attr({"disabled":"disabled"});
				$('#xianshi').removeAttr("checked");
				$('#subtitle').attr({"disabled":"disabled"});
				$('#subtitle').removeAttr("checked");
		}
		$("#p_playscene").click(function(){
			var playscene = $("#p_playscene").val();
			switch(playscene){
			case "cinema":
				$('#xianshi').attr({"disabled":"disabled"});
				$('#xianshi').removeAttr("checked");
				$('#subtitle').attr({"disabled":"disabled"});
				$('#subtitle').removeAttr("checked");
				$('#copyrightmark').css("display","none");
				break;
			default:
				$('#xianshi').removeAttr("disabled");
				$('#xianshi').removeAttr("checked");
				$('#subtitle').removeAttr("disabled");
				$('#subtitle').removeAttr("checked");
			}
			});
	}
	else if(value=='F'){
	$('#chose-stream').css("display","block");
	$('#p_playscene').css("display","none");
	$('#f_playscene').css("display","block");
	$('#xianshi').attr({"disabled":"disabled"});
	$('#xianshi').prop("checked",true);
	$('#mark').css("display","block");
	$('#copyrightmark').css("display","none");
	}
	});
/*	
$("#playscene").click(function(){
	var value_scene =$("#playscene").val();
	if(value_scene=='person'){
	$('#mark').css("display","block");
		}
	else if(value_scene=='cinema'){
	$('#mark').css("display","none");
	}
	});
*/
});
$(document).ready(function(){
  $(".xianshi").click(function(){
  $("#copyrightmark").toggle();
  });
});

//toggle() 方法切换元素的可见状态。

/*function aa(){
   var boxtest=document.getElementById("xianshi").checked;
   //console.log(boxtest);
if(boxtest=="true"){
   var user1=$("[name=timeinterval]").val();
   var user2=$("[name=randominterval]").val();//调用的是jquery的函数
   var user3=document.authForm.displaytime.value;
   var user4=document.authForm.displayrandom.value;//跟上面的定义方法一样
   var zz1=/^[0-9_]{1,10}$/;//数字0-9；
   //alert(Number(user2)+"."+Number((user1)/2)) ;
	//return false; 
	   if(!zz1.test(user1)||!zz1.test(user2)||!zz1.test(user3)||!zz1.test(user4))
	   {
			alert("您输入的不是数字或者未填全其他数据");
			return false; 
			//alert(user1+"."+user2) ;//(测试下一行为什么要加Number)
	    }
			if(Number(user1)<40000)
			{
				alert("时间间隔的值最小为40000s");
				return false;
				exit; 
	                } 
				if(Number(user2)>Number((user1)/2))//注意Number的用法（将user1，user2转变为数）
						   {
							  alert("提示：随机区间的值须小于时间间隔的值的1/2");
							  //document.write("ok");
							 return false;
						   }
				}else if(boxtest=="false"){ return false; }
			}*/
  
 
</script>
<style>
		#shuju
		{
			border:1px solid #d8d8d8; heigh:10px; width:50px;
		} 
		label{
			display: inline;
		}
</style>

<div align="center">
	<img src="img/vec_logo1.jpg" />
</div>

<!-- jquery插件 -->
<div id="tabs" style="width:955px;margin:0 auto;height:570px;">
<ul>
<li><a href="#tabs-1">微视频授权</a></li>
<li><a href="#tabs-2" id="outdated_copy">过期拷贝清除</a></li>
<li><a href="#tabs-3">未过期拷贝浏览</a></li>
<li style="float:right"><input type="button" value="返回首页" onclick="window.location.href='http://222.31.64.168/chinavec/index.php'"/></li>
</ul>
<div id="tabs-1">
<!--<div class="authBody" style="margin-left:-25px;margin-top:-23px;height:530px;">-->
<div class="authBody" style="height:530px;">
	<p><h1 style="margin-top:0px;margin-bottom:0px;">微视频授权系统</h1></p>
		<?php
			if(isset($_POST['svideo'])){
			$_SESSION['name'] = $_POST['svideo'];
			//echo $_SESSION['name'];
			
			}			
			$svideo = $_SESSION['name'];

			$sql = "SELECT `title_cn` FROM `video` WHERE id='$svideo'";
			$result = mysql_query($sql);
			$result_row = mysql_fetch_row($result);
			$videoname = $result_row[0];

			//print_r($videoname);
			//exit;
				/*$name=$_POST['user'];
				$sql = "SELECT title_cn FROM `video`";
				$result = mysql_query($sql);
				while ($result_row = mysql_fetch_assoc($result)) {
					echo <<<OPTION
					<option value="{$result_row['title_cn']}">{$result_row['title_cn']}</option>
OPTION;
				}
			?>*/
			?>
	<form id="authForm" name="authForm" action="do.php" method="post" enctype="multipart/form-data">
			<br/>
			<input type="hidden" id="titlecn" name="titlecn" value="<?php echo $videoname;?>"/>				
				<p style="height:25px;margin:25px 0 10px 0;width:800px">
					选择授权视频：&nbsp;&nbsp;<?php echo $videoname;?>
					<a name="choose" style="margin-left:20px;color:#4876FF;padding-right:80px;" href='play.php' target='_self'>点击重新选择视频</a>
				</p>
				<!--select type="text" name="titlecn">
				<option value="<?php echo $videoname;?>"><?php echo $videoname;?></option>
			</select-->
		<p><span style="float:left;margin:0;height:35px;line-height:35px;">选择授权类型：</span>
			<select id="authtype" type="text" name="authtype" style="margin-left:15px;float:left;">
				<option value="F">公益授权</option>
				<option value="P">付费授权</option>
			</select>
			<select id="f_playscene" class="f_playscene" type="text"  name="f_playscene" style="margin-left:10px;width:30%;float:left;">
				<option value="free_screen">公益展映</option>
				<option value="person">个人终端</option>
				<option value="salon">娱乐沙龙</option>
				<option value="communcation">课堂交流</option>


			</select>
			<select id="p_playscene" class="p_playscene" type="text"  name="p_playscene" style="display:none;margin-left:10px;width:30%;float:left;">
				<option value="internet">互联网</option>
				<option value="person">个人终端</option>
				<option value="cinema">影院播放</option>
				<option value="screening">展映</option>
				<option value="tv">电视频道</option>
				<option value="inter_tv">互动电视</option>
				<option value="iptv">IPTV</option>
				<option value="ott">OTT</option>
				<option value="carscreen">车载屏</option>
				<option value="airscreen">航空视频</option>
				<option value="bigscreen">大屏</option>
				<option value="buildscreen">楼宇电视</option>
				<option value="outscreen">户外显示屏</option>
				<option value="mobilescreen">移动传媒</option>
				<option value="salon">娱乐沙龙</option>
				<option value="communcation">课堂交流</option>

			</select>
		</p>
		<p style="clear:both;" style="display:none">
			<span>请输入有效期：</span><input type="text" name="valid_dt" id="datepicker" placeholder="请输入有效期" style="margin-left:14px" />
		</p>
		<p>选择视频格式：
			<select type="text" name="format" style="width:86px;margin:0;margin-left:6px">
				<option value="mpg">mpg</option>
				<option value="avi">avi</option>
			</select>
		</p>
		<p id="chose-stream">选择视频码流：
			<select type="text" name="stream" style="width:86px;margin:0;margin-left:6px">
				<option value="normal" select="selected">正常</option>
				<option value="low">低质量</option>
			</select>
		</p>
		<p id="mark" > 
		<label><input name="xianshi" id="xianshi" class="xianshi" type="checkbox" disabled="disabled" checked="checked"/>
		版权角标&nbsp;&nbsp;&nbsp;</label>
		<label><input name="subtitle" id="subtitle" class="subtitle" type="checkbox" />
		竖版字幕</label>
		</p>
			<div style="display:none;margin-left:8px;width:900px" id="copyrightmark">时间间隔(ms)：<input name="timeinterval" type="text" class="shuju01" id="shuju" placeholder="最小40000ms" style="width:80px;margin-left:7px;margin-right:0px;font-size:10px" /> 随机区间(ms):<input name="randominterval" type="text" class="shuju01" id="shuju" style="width:68px;margin-left:15px;font-size:8px" placeholder="小于间隔1/2"/> 
			<span style="font-size:5px;color:#999999">*间隔最大60000ms</span><br/> 
			 显示时长(ms)：<input name="displaytime" type="text" class="shuju01" id="shuju" placeholder="最小5000ms" style="width:80px;margin-left:7px;margin-right:0px;font-size:10px" />随机区间(ms):<input name="displayrandom" type="text" class="shuju01" id="shuju" style="width:68px;margin-left:15px;font-size:8px" placeholder="小于时长1/2"/> 
			<span style="font-size:5px;color:#999999">*时长最大10000ms</span> <br/> 
			</div>


		<p>
			请输入授权目的：<input type="text" name="purpose" id="purpicker" placeholder="请输入授权目的" />
		</p>
		<p><button name="submit" type="submit" class="btn btn-primary" style="margin:0">点击授权</button><a name="logout" type="button" class="btn" href='loginout.php' style="margin-left:150px;">退出</a></p>	
		</form>
	
</div>
</div>
<div id="tabs-2">
<p>



</p>
</div>
<div id="tabs-3" style="padding:0px 0px 0px 0px;">

	<?php include "listdownload.php";?>
	<!--<span>id</span>title_cn<span></span><span></span><span></span><span></span><span></span>-->
</div>
<!--<a href="#tabs-3" onclick="document.location.href='index.php'">ssss</a>-->
</div>

<!-- jquery插件结束 -->

<!--授权判断开始-->
<script type="text/javascript">
$(function() {

      $("#authForm").submit(function() {
      var value1 =$("#authtype").val();
      if(value1=='P'){
      var boxtest=document.getElementById("xianshi").checked;
      //console.log(boxtest);
      if(boxtest){	
      if ($("#titlecn").val() && $("#datepicker").val() && $("#purpicker").val() && boxtest) 
            {
      var user1=$("[name=timeinterval]").val();
      var user2=$("[name=randominterval]").val();//调用的是jquery的函数
      var user3=document.authForm.displaytime.value;
      var user4=document.authForm.displayrandom.value;//跟上面的定义方法一样
      var zz1=/^[0-9_]{1,10}$/;//数字0-9；
      //alert(Number(user2)+"."+Number((user1)/2)) ;
      //return false; 
	   if(!zz1.test(user1)||!zz1.test(user2)||!zz1.test(user3)||!zz1.test(user4))
	          {
			alert("您输入的不是数字或者未填全其他数据");
			return false; 
			//alert(user1+"."+user2) ;//(测试下一行为什么要加Number)
	          }
			if(Number(user1)<40000)
			{
				alert("时间间隔的值最小为40000s");
				return false;
				exit; 
	                } 
				if(Number(user2)>Number((user1)/2))//注意Number的用法（将user1，user2转变为数）
						   {
							  alert("提示：随机区间的值须小于时间间隔的值的1/2");
							  //document.write("ok");
							 return false;
                                               
						   }
	  }
               
						else {
							alert("请填写完整信息！");
							return false;
						     }
             }
      
                                    else if(!boxtest)   {
                                                     if ($("#titlecn").val() && $("#datepicker").val() && $("#purpicker").val()) {
								return true;}
							else {
								alert("请填写完整信息！");
								return false;
							     }   
                                                                 }
		}
                                        else if(value1=='F')
                                                {
		                                          if ($("#titlecn").val() && $("#datepicker").val() && $("#purpicker").val()) {
								return true;
							}
							else {
								alert("请填写完整信息！");
								return false;
							     }
                                                }  
					});
				});
</script>
<!--授权判断结束-->


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
