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
<script type="text/javascript">
//placeholder IE8
var _placeholderSupport = function() {
    var t = document.createElement("input");
    t.type = "text";
    return (typeof t.placeholder !== "undefined");
}();


window.onload = function() {
    var arrInputs = document.getElementsByTagName("input");
    for (var i = 0; i < arrInputs.length; i++) {
        var curInput = arrInputs[i];
        if (!curInput.type || curInput.type == "" || curInput.type == "text")
            HandlePlaceholder(curInput);
    }
};
 
function HandlePlaceholder(oTextbox) {
    if (!_placeholderSupport) {
        var curPlaceholder = oTextbox.getAttribute("placeholder");
        if (curPlaceholder && curPlaceholder.length > 0) {
            oTextbox.value = curPlaceholder;
            oTextbox.setAttribute("old_color", oTextbox.style.color);
            oTextbox.style.color = "#c0c0c0";
            oTextbox.onfocus = function() {
                this.style.color = this.getAttribute("old_color");
                if (this.value === curPlaceholder)
                    this.value = "";
            };
            oTextbox.onblur = function() {
                if (this.value === "") {
                    this.style.color = "#c0c0c0";
                    this.value = curPlaceholder;
                }
            }
        }
    }
}
</script>
<script>
$(function() {
$( "#tabs" ).tabs();
});

$(document).ready(function(){
	$("#outdated_copy").click(function(){
		$("#tabs-2").load("delete.php",{out:"",id:""});
	});
	$("#tab4").click(function(){
		window.location.href='http://222.31.88.66/chvec_auth/ind.php?page_no=1#tabs-4';
	});
	$("#tab3").click(function(){
		window.location.href='http://222.31.88.66/chvec_auth/ind.php?page_no=1#tabs-3';
	});

});
</script>
<script type="text/javascript">
$(document).ready(function(){
  $(".xianshi").click(function(){
  $("#copyrightmark").toggle();
  });
});

//toggle() 方法切换元素的可见状态。
//input placehoder


//input placehoder


function aa(){
   var user1=$("[name=timeinterval]").val();
   var user2=$("[name=randominterval]").val();//调用的是jquery的函数
   var user3=document.authForm.displaytime.value;
   var user4=document.authForm.displayrandom.value;//跟上面的定义方法一样
   var zz1=/^[0-9_]{1,10}$/;//数字0-9；
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
  
 
</script>
<style>
		#shuju
		{
			border:1px solid #d8d8d8; heigh:10px; width:50px;
		} 
</style>

<div align="center">
	<img src="img/vec_logo1.jpg" />
</div>

<!-- jquery插件 -->
<div id="tabs" style="width:955px;margin:0 auto;height:570px;">
<ul>
<li><a href="#tabs-1" id="tab1">微视频授权</a></li>
<li><a href="#tabs-2" id="outdated_copy">过期拷贝清除</a></li>
<li><a href="#tabs-3" id="tab3">未过期拷贝浏览</a></li>
<li><a href="#tabs-4" id="tab4">已过期拷贝存根</a></li>
<li style="float:right"><input type="button" value="返回首页" onclick="window.location.href='http://222.31.88.66/chinavec/index.php'"/></li>
</ul>
<div id="tabs-1">
<!--<div class="authBody" style="margin-left:-25px;margin-top:-23px;height:530px;">-->
<div class="authBody" style="height:530px;">
	<h1 style="margin-top:0px;margin-bottom:0px;">微视频授权系统</h1>
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
	<form id="authForm" name="authForm" onSubmit="return aa()" action="do.php" method="post" enctype="multipart/form-data">
</br>
			<input type="hidden" id="titlecn" name="titlecn" value="<?php echo $videoname;?>"/>				
				<p style="height:25px;margin:25px 0 10px 0;width:900px">
					选择授权视频：&nbsp;&nbsp;<?php echo $videoname;?>
					<a name="choose" style="margin-left:20px;color:#4876FF;padding-right:80px;" href='play.php' target='_self'>点击重新选择视频</a>
				</p>
				<!--select type="text" name="titlecn">
				<option value="<?php echo $videoname;?>"><?php echo $videoname;?></option>
			</select-->
		<p>选择授权类型：
			<select type="text" name="authtype" style="margin-left:4px">
				<option value="F">公益授权</option>
				<option value="P">付费授权</option>
			</select>
		</p>
		<p>
			请输入有效期：<input type="text" name="valid_dt" id="datepicker" placeholder="请输入有效期" style="margin-left:12px"/>
		</p>
		<p>选择视频格式：
			<select type="text" name="format" style="width:86px;margin:0;margin-left:6px">
				<option value="mpg">mpg</option>
				<option value="avi">avi</option>
			</select>
		</p>

		<p> 
		<input name="xianshi" class="xianshi" type="checkbox"/>
		<span>版权角标</span>
		</p>
			<div style="display:none;margin-left:68px;" id="copyrightmark">时间间隔(ms):<input name="timeinterval" type="text" class="shuju01" id="shuju" placeholder="最小40s" style="width:58px;margin-left:17px;margin-right:10px;" />随机区间(ms):<input name="randominterval" type="text" class="shuju01" id="shuju" style="margin-left:15px;"/> <br/> 
			 显示时长(ms):<input name="displaytime" type="text" class="shuju01" id="shuju" placeholder="最小5s" style="width:58px;margin-left:15px;margin-right:10px;" />随机区间(ms):<input name="displayrandom" type="text" class="shuju01" id="shuju" style="margin-left:15px;"/> <br/> 
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
<div id="tabs-4" style="padding:0px 0px 0px 0px;">

	<?php include "listbackup.php";?>
	<!--<span>id</span>title_cn<span></span><span></span><span></span><span></span><span></span>-->
</div>
<!--<a href="#tabs-3" onclick="document.location.href='index.php'">ssss</a>-->
</div>

<!-- jquery插件结束 -->

<!--授权判断开始-->
<script type="text/javascript">
				$(function() {
					
					$("#authForm").submit(function() {
						if ($("#titlecn").val() && $("#datepicker").val() && $("#purpicker").val()) {
							return true;
						}
						else {
							alert("请填写完整信息！");
							return false;
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
