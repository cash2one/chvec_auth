<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--
<link href="css/redmond/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
 -->
<title>授权微视频库</title>
<link type="text/css" href="css/weishipin.css" rel="stylesheet"/>
</head>

<body>
	
<table class="table table-bordered" style="width:955px;margin:auto">
<thead style="border:solid 1px #bfcfda;background:-webkit-gradient(linear, left top, left bottom, from(#f4f5f8), to(#dce3eb));background:-moz-linear-gradient(top,#f4f5f8,#dce3eb);background:-o-linear-gradient(top,#f4f5f8,#dce3eb);filter:progid:DXImageTransform.Microsoft.Gradient(
    StartColorStr=#f4f5f8,EndColorStr=#dce3eb,GradientType=0);background-color:#dce3eb;">
  <tr style="border-right:solid 1px #bfcfda;color:#000;">
	<th>中文片名</th>
	<th>英文片名</th>
	<th>授权类型</th> 
	<th>授权码</th> 
	<th>有效期</th>
    	<th>授权目的</th>
    	<th>下载地址</th>  
  </tr> 
</thead>
    <?php
      require_once("lib/connect.php");
      $now=date('Y-m-d');
      $page_num =8;//每页记录数为8
      if (!isset($_GET['page_no']))//page_no 空
      {
          $page_no = 1;
      }
      else {
          $page_no = $_GET['page_no'];
      }
      $start_num = $page_num * ($page_no - 1);//起始行号
      //$sql = "SELECT * FROM  `authen` where `valid_dt`>'$now' order by `id` desc LIMIT $start_num , $page_num ";
      $sql = "SELECT * FROM  `authen` inner join `video` on `video`.`id` = `authen`.`video_id` where `valid_dt`>'$now' order by `authen`.`id` desc LIMIT $start_num , $page_num ";
//$sql = "SELECT * FROM `video`";
      $result = mysql_query($sql);
      $nums = mysql_num_rows($result); 
      //$nm = mysql_num_rows($result);
      while ($result_row = mysql_fetch_assoc($result)) {
	if(mb_strlen($result_row['purpose'],'utf8')>10){
		$purpose = mb_substr($result_row['purpose'],0,6,'utf-8')."...";
		}else{$purpose=$result_row['purpose'];}
	if(mb_strlen($result_row['title_en'],'utf8')>26){
		$title_en = mb_substr($result_row['title_en'],0,25,'utf-8')."...";
		}else{$title_en=$result_row['title_en'];}
	//$purpose = mb_substr($result_row['purpose'],0,6,'utf-8')."...";
	//$title_en = mb_substr($result_row['title_en'],0,23,'utf-8')."...";
	echo <<<TR
  <tr style="border-right:solid 1px #bfcfda;color:#000;">
	<td>{$result_row['title_cn']}</td>
	<td title='{$result_row['title_en']}'>$title_en</td>     
	<td>{$result_row['type']}</td> 
	<td>{$result_row['code']}</td> 
	<td>{$result_row['valid_dt']}</td>
	<td title='{$result_row['purpose']}'>$purpose</td> 
TR;
	$file_dir = "/var/www/chvec_auth/video_auth/";
	if (file_exists($file_dir.$result_row['code'].".mpg")){
	
	
        echo <<<TR
	<td><a href="fdown.php?name={$result_row['code']}.mpg">点击下载</a></td> 
  </tr> 
TR;
	}elseif(file_exists($file_dir.$result_row['code'].".avi")){
	
	echo <<<TR
	<td><a href="fdown.php?name={$result_row['code']}.avi">下载</a></td> 
  </tr> 
TR;
	}else{
	echo <<<TR
	<td>视频缺失</td> 
  </tr> 
TR;
	}
	
      }
    ?>

</table>

<div id="footer">
  <span id="jilu1">显示<?php echo $nums; ?>条记录</span>
    <span style="test-align:center;">
        <?php
		$sql1 = "SELECT * from `authen` where `valid_dt`>'$now'";
		$result1 = mysql_query($sql1);
		$numss = mysql_num_rows($result1);
		$page = ceil($numss/$page_num);
            if ($page_no > 1) {
                    echo "<a href ='?page_no=".($page_no-1)."#tabs-3'>上一页</a>&nbsp;&nbsp;&nbsp;";
                }else{
                    echo '<span>上一页</span>&nbsp;&nbsp;&nbsp;';
                }
                echo '<strong>第'.$page_no.'页/共'.$page.'页</strong>';
                if ($nums == $page_num) {
			echo "&nbsp;&nbsp;&nbsp;<a href ='?page_no=".($page_no+1)."#tabs-3'>下一页</a>";
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
