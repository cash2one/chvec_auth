<?php
session_start();
if((@!$_SESSION['user'])or(@!$_SESSION['password'])){
//echo "<script type=\"text/javascript\">alert('请先登录');</script>";
			 header("refresh:0;url=login.php");//跳转页面
			//echo "<script type=\"text/javascript\">window.location.href=\"login.php\";</script>";
}
?>
<?php include 'lib/header.php';
	//include"lib/connect.php"; ?>
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
/*
	.authcontent{
		text-align:center;
		position:relative;
		margin:40px auto 0px auto;
	}
	.selauthvideo{
		margin:0px 0px 0px 315px;
		height:40px;
	}
	.row{
		
		height:40px;
	}
	.column1{
		width:150px;
		padding:2px;
	}
*/
</style>



<script>
$(function() {
$( "#tabs" ).tabs();
});


</script>



<div align="center">
	<img src="img/vec_logo1.jpg" />
</div>

<!-- jquery插件 -->
<div id="tabs" style="width:955px;margin:0 auto;height:450px;">
<ul>
<li><a href="#tabs-1" id="tab1">已授权列表</a></li>

<li style="float:right"><input type="button" value="返回" onclick="window.location.href='http://222.31.64.168/chvec_auth/index.php?page_no=1#tabs-<?=$_GET['tabs']?>'"/></li>
</ul>
<div id="tabs-1">
	
<table class="table table-bordered" style="width:955px;margin:auto">
<thead style="border:solid 1px #bfcfda;background:-webkit-gradient(linear, left top, left bottom, from(#f4f5f8), to(#dce3eb));background:-moz-linear-gradient(top,#f4f5f8,#dce3eb);background:-o-linear-gradient(top,#f4f5f8,#dce3eb);filter:progid:DXImageTransform.Microsoft.Gradient(
    StartColorStr=#f4f5f8,EndColorStr=#dce3eb,GradientType=0);">
  <tr style="border-right:solid 1px #bfcfda;color:#000;">
	<th>中文片名</th>
	<th>英文片名</th>
	<th>授权类型</th> 
	<th>授权码</th> 
	<th>有效期</th>
    	<th>授权目的</th>
  </tr> 
</thead>
    <?php
      require_once("lib/connect.php");
      $now=date('Y-m-d');
      $page_num =8;//每页记录数为8
      $name=$_GET['name'];
      if (!isset($_GET['page_no']))//page_no 空
      {
          $page_no = 1;
      }
      else {
          $page_no = $_GET['page_no'];
      }
      $start_num = $page_num * ($page_no - 1);//起始行号
      $sql = "SELECT * FROM  `authen` inner join `video` on `video`.`id` = `authen`.`video_id` where `authen`.`title_cn`='$name' order by `authen`.`id` desc LIMIT $start_num , $page_num ";
//$sql = "SELECT * FROM `video`";
      $result = mysql_query($sql);
      $sqlnum = "SELECT * FROM  `authen` inner join `video` on `video`.`id` = `authen`.`video_id` where `authen`.`title_cn`='$name' order by `authen`.`id` desc ";
      $resultnum = mysql_query($sqlnum);
      $nums = mysql_num_rows($result); 
      $num = mysql_num_rows($resultnum); 
      //$nm = mysql_num_rows($result);
      $sqlv="SELECT * FROM  `video` where `title_cn`='$name' ";
      $resultv = mysql_query($sqlv);
      $row = mysql_fetch_array($resultv);
      $title_en = mb_substr($row['title_en'],0,25,'utf-8')."...";

      echo "
	    <tr style='border-right:solid 1px #bfcfda;color:#000;'> 
	    <th rowspan='10'>{$name}<br>(共授权{$num}部)</th>
	    
	    <th rowspan='10'>$title_en</th> 	
	   ";
      while ($result_row = mysql_fetch_assoc($result)) {
	$purpose = mb_substr($result_row['purpose'],0,6,'utf-8')."...";
	//$title_en = mb_substr($result_row['title_en'],0,25,'utf-8')."...";
	echo <<<TR
     
	<td>{$result_row['type']}</td> 
	<td>{$result_row['code']}</td> 
	<td>{$result_row['valid_dt']}</td>
	<td title='{$result_row['purpose']}'>$purpose</td>
  <tr>
TR;

	/*if (file_exists($file_dir.$result_row['code'].".mpg")){
	
	
        echo <<<TR
	<td><a href="fdown.php?name={$result_row['code']}.mpg">下载</a></td> 
  </tr> 
TR;
	}elseif(file_exists($file_dir.$result_row['code'].".avi")){
	
	echo <<<TR
	<td><a href="fdown.php?name={$result_row['code']}.avi">下载</a></td> 
  </tr> 
TR;
	}else{
	echo <<<TR
	<td>缺失</td> 
  </tr> 
TR;
	}*/
	
      }
    ?>

</table>

<div id="footer">
  <span id="jilu1">显示<?php echo $nums; ?>条记录</span>
    <span style="test-align:center;">
        <?php
		$sql1 = "SELECT * from `authen` where `title_cn`='$name'";
		$result1 = mysql_query($sql1);
		$numss = mysql_num_rows($result1);
		$page = ceil($numss/$page_num);
            if ($page_no > 1) {
                    echo "<a href ='?page_no=".($page_no-1)."&name={$name}&tabs=3'>上一页</a>&nbsp;&nbsp;&nbsp;";
                }else{
                    echo '<span>上一页</span>&nbsp;&nbsp;&nbsp;';
                }
                echo '<strong>第'.$page_no.'页/共'.$page.'页</strong>';
                if ($nums == $page_num) {
			echo "&nbsp;&nbsp;&nbsp;<a href ='?page_no=".($page_no+1)."&name={$name}&tabs=3'>下一页</a>";
			//echo "&nbsp;&nbsp;&nbsp;<a href ='#tabs-3?page_no=".($page_no+1)."'>下一页</a>";		
                }else{
                    echo '&nbsp;&nbsp;&nbsp;<span>下一页</span>';
                }
        //include "lib/footer.php";
        ?>
    </span>          
</div>


</body>
</html>
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
</div>
</div>
<?php include "lib/footer.php"; ?>
